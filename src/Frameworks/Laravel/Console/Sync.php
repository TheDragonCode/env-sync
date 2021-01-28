<?php

namespace Helldar\EnvSync\Frameworks\Laravel\Console;

use Helldar\EnvSync\Services\Syncer;
use Illuminate\Console\Command;

final class Sync extends Command
{
    protected $signature = 'env:sync {--path=}';

    protected $description = 'Synchronizing environment settings with a preset.';

    public function handle(Syncer $syncer)
    {
        $syncer
            ->path($this->path())
            ->filename($this->filename())
            ->store();
    }

    protected function path(): string
    {
        return $this->optionPath() ?: $this->realPath();
    }

    protected function filename(): string
    {
        return '.env.example';
    }

    protected function optionPath(): ?string
    {
        return $this->option('path');
    }

    protected function realPath(): string
    {
        return realpath(base_path());
    }
}
