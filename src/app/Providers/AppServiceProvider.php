<?php

namespace App\Providers;

use App\Lib\LinkPreview\LinkPreview;
use App\Lib\LinkPreview\LinkPreviewInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkPreviewInterface::class, LinkPreview::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
