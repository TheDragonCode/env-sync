<?php

namespace Helldar\EnvSync;

use Helldar\EnvSync\Console\Sync;
use Helldar\EnvSync\Support\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerCommands();
        $this->registerConfig();
    }

    public function boot()
    {
        $this->bootConfig();
    }

    protected function registerCommands(): void
    {
        $this->commands(Sync::class);
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/env-sync.php', 'env-sync');

        $this->app->singleton(Config::class, static function ($app) {
            return new Config($app['config']->get('env-sync'));
        });
    }

    protected function bootConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/env-sync.php' => $this->app->configPath('env-sync.php'),
        ], 'config');
    }
}
