<?php

namespace Helldar\EnvSync;

use Helldar\EnvSync\Console\Sync;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        $this->commands(Sync::class);
    }
}
