<?php

namespace LunarExtend\Sitemap;

use Illuminate\Support\ServiceProvider;
use LunarExtend\Sitemap\Commands\GenerateSitemap;

class SitemapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sitemap.php', "lunar-extend.sitemap");
    }

    public function boot(): void
    {
        $this->commands([
            GenerateSitemap::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/sitemap.php' => config_path('lunar-extend/sitemap.php'),
        ], 'lunar.extend.config');
    }
}
