<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Product;

interface ProductUrlGeneratorInterface
{
    public function getUrl(Product $product): string;
}