<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Brand;

class BrandUrlGenerator implements BrandUrlGeneratorInterface
{
    public function getUrl(Brand $brand): string
    {
        return route('brand.view', $brand->defaultUrl->slug);
    }
}