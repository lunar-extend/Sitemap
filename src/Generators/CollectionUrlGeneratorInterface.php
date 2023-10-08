<?php

namespace LunarExtend\Sitemap\Generators;

use Lunar\Models\Collection;

interface CollectionUrlGeneratorInterface
{
    public function getUrl(Collection $collection): string;
}