<?php

namespace Revolution\Socialite\Qiita;

use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Contracts\Factory;

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
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('qiita', function ($app) use ($socialite) {
            $config = $this->app['config']['services.qiita'];

            return $socialite->buildProvider(QiitaProvider::class, $config);
        });
    }
}
