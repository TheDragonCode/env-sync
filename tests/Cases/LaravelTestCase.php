<?php

namespace Tests\Cases;

use Helldar\EnvSync\Frameworks\Laravel\ServiceProvider;
use Helldar\Support\Facades\Helpers\Filesystem\File;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class LaravelTestCase extends BaseTestCase
{
    use Configurable;
    use Files;

    protected function setUp(): void
    {
        parent::setUp();

        $this->clean();
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function clean(): void
    {
        $this->deleteFiles();
    }

    protected function deleteFiles(): void
    {
        File::delete($this->targetPath());
    }
}
