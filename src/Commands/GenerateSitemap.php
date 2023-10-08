<?php

namespace LunarExtend\Sitemap\Commands;

use Illuminate\Console\Command;
use Lunar\Models\Brand;
use Lunar\Models\Collection;
use Lunar\Models\Product;
use LunarExtend\Stub\Facades\StubFacade;

class GenerateSitemap extends Command
{

    protected $signature = 'lunar-extend:generate-sitemap';

    protected $description = 'Generate sitemap file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() : bool
    {
        $urlStubs = [];

        if (config('lunar-extend.sitemap.homepage_route') != null) {
            $urlStubs[] = StubFacade::load(__DIR__.'/../../stubs/sitemapUrl.stub')
                ->replace('url', route(config('lunar-extend.sitemap.homepage_route')))
                ->replace('date', date('Y-m-d\Th:m:s+00:00'))
                ->get();
        }

        $this->loadProducts($urlStubs);
        $this->loadCollections($urlStubs);
        $this->loadBrands($urlStubs);

        $stubContent = implode(PHP_EOL, $urlStubs);

        StubFacade::load(__DIR__.'/../../stubs/sitemap.stub')
            ->replace('urls', $stubContent)
            ->generate(public_path('sitemap.xml'));

        $this->info('Sitemap generated');

        return true;
    }

    private function loadProducts(array &$urlStubs) : void
    {
        if (!config('lunar-extend.sitemap.products'))
            return;

        $products = Product::whereHas('variants')
            ->whereHas('defaultUrl')->limit(3)
            ->get();

        foreach ($products as $product)
        {
            $urlStubs[] = StubFacade::load(__DIR__.'/../../stubs/sitemapUrl.stub')
                ->replace('url', $this->getUrl('products', $product))
                ->replace('date', $product->variants->first()->updated_at->format('Y-m-d\Th:m:s+00:00'))
                ->get();
        }
    }

    private function loadCollections(array &$urlStubs) : void
    {
        if (!config('lunar-extend.sitemap.collections'))
            return;

        $collections = Collection::whereHas('defaultUrl')
            ->get();

        foreach ($collections as $collection)
        {
            $urlStubs[] = StubFacade::load(__DIR__.'/../../stubs/sitemapUrl.stub')
                ->replace('url', $this->getUrl('collections', $collection))
                ->replace('date', $collection->updated_at->format('Y-m-d\Th:m:s+00:00'))
                ->get();
        }
    }

    private function loadBrands(array &$urlStubs) : void
    {
        if (!config('lunar-extend.sitemap.brands'))
            return;

        $brands = Brand::whereHas('defaultUrl')
            ->get();

        foreach ($brands as $brand)
        {
            $urlStubs[] = StubFacade::load(__DIR__.'/../../stubs/sitemapUrl.stub')
                ->replace('url', $this->getUrl('brands', $brand))
                ->replace('date', $brand->updated_at->format('Y-m-d\Th:m:s+00:00'))
                ->get();
        }
    }

    private function getUrl(string $type, $model)
    {
        $generator = config('lunar-extend.sitemap.'.$type);

        if (!$generator) {
            return null;
        }

        return app($generator)->getUrl($model);
    }

}
