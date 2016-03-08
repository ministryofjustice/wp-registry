<?php

namespace App\Providers;

use App\Services\WordPressVersion;
use Illuminate\Support\ServiceProvider;

class WordPressVersionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WordPressVersion::class, function () {
            return new WordPressVersion();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [WordPressVersion::class];
    }
}
