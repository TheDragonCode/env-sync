<?php

namespace Helldar\EnvSync\Frameworks\Laravel;

use Helldar\EnvSync\Frameworks\Laravel\Console\Sync;
use Helldar\EnvSync\Support\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @deprecated Starting with version 2.0, this functionality will be moved to the andrey-helldar/env-sync-laravel package.
 */
final class ServiceProvider extends BaseServiceProvider
{
    protected $config_path = __DIR__ . '/../../../config/env-sync.php';

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
        $this->mergeConfigFrom($this->config_path, 'env-sync');

        $this->app->singleton(Config::class, static function ($app) {
            return new Config($app['config']->get('env-sync'));
        });
    }

    protected function bootConfig(): void
    {
        $this->publishes([
            $this->config_path => $this->app->configPath('env-sync.php'),
        ], 'config');
    }
}
