<?php

namespace Helldar\EnvSync\Console;

use Helldar\EnvSync\Services\Syncer;
use Illuminate\Console\Command;

final class Sync extends Command
{
    protected $signature = 'env:sync {--path=}';

    protected $description = 'Synchronizing environment settings with a preset.';

    public function handle(Syncer $service)
    {
        $service
            ->from($this->source())
            ->to($this->target())
            ->store();
    }

    protected function source(): string
    {
        return $this->path('.env');
    }

    protected function target(): string
    {
        return $this->path('.env.example');
    }

    protected function path(string $filename): string
    {
        if ($path = $this->option('path')) {
            return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
        }

        return base_path($filename);
    }
}
