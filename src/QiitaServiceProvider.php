<?php

namespace Revolution\Socialite\Qiita;

use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class QiitaServiceProvider extends SocialiteServiceProvider
{
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
