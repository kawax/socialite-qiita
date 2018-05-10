<?php

namespace Revolution\Socialite\Qiita;

use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Facades\Socialite;

class QiitaServiceProvider extends SocialiteServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        Socialite::extend('qiita', function ($app) {
            $config = $app['config']['services.qiita'];

            return Socialite::buildProvider(QiitaProvider::class, $config);
        });
    }
}
