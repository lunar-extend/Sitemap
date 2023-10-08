<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Brand;

interface BrandUrlGeneratorInterface
{
    public function getUrl(Brand $brand): string;
}