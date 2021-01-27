<?php

namespace Tests\Cases;

use Helldar\EnvSync\ServiceProvider;
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
        $this->copyEnv();
    }

    protected function deleteFiles(): void
    {
        $source = base_path('.env');
        $target = base_path('.env.example');

        File::delete([$source, $target]);
    }

    protected function copyEnv(): void
    {
        copy(__DIR__ . '/../fixtures/' . $this->fixture_source, base_path('.env'));
    }
}
