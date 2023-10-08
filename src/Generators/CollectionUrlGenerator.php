<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Collection;

class CollectionUrlGenerator implements CollectionUrlGeneratorInterface
{
    public function getUrl(Collection $collection): string
    {
        return route('collection.view', $collection->defaultUrl->slug);
    }
}