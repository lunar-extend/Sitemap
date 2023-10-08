<?php

return [
'homepage_route' => 'home',
'products' => LunarExtend\Sitemap\Generators\ProductUrlGenerator::class,
'collections' => LunarExtend\Sitemap\Generators\CollectionUrlGenerator::class,
'brands' => LunarExtend\Sitemap\Generators\BrandUrlGenerator::class,
];