<?php

namespace Arealtime\Auth\App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/arealtime-auth.php',
            'arealtime-auth'
        );
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'auth');
    }
}
