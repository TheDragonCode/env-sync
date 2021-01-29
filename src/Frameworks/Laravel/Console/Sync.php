<?php

namespace Helldar\EnvSync\Frameworks\Laravel\Console;

use Helldar\EnvSync\Services\Syncer;
use Illuminate\Console\Command;

final class Sync extends Command
{
    protected $signature = 'env:sync {--path= : Gets the path to scan for files}';

    protected $description = 'Synchronizing environment settings with a preset.';

    public function handle(Syncer $syncer)
    {
        $this->info('Searching...');

        $filename = $this->filename();

        $this->sync($syncer, $filename);

        $this->info("The found keys were successfully saved to the {$filename} file.");
    }

    protected function sync(Syncer $syncer, string $filename): void
    {
        $syncer
            ->path($this->path())
            ->filename($filename)
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
