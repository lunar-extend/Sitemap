<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Product;

class ProductUrlGenerator implements ProductUrlGeneratorInterface
{
    public function getUrl(Product $product): string
    {
        return route('product.view', $product->defaultUrl->slug);
    }
}