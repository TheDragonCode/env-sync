<?php

namespace Tests\Laravel;

use Helldar\Support\Exceptions\FileNotFoundException;
use Tests\Cases\LaravelTestCase;

final class ConfigurableTest extends LaravelTestCase
{
    protected $fixture_expected = 'expected-config';

    protected $fixture_source = 'source-config';

    public function testCommand()
    {
        $this->artisan('env:sync')->assertExitCode(0)->run();

        $this->assertFileExists(base_path('.env.example'));
        $this->assertFileEquals($this->expected(), base_path('.env.example'));
    }

    public function testCustomPath()
    {
        $this->artisan('env:sync', ['--path' => base_path()]);

        $this->assertFileExists(base_path('.env.example'));
        $this->assertFileEquals($this->expected(), base_path('.env.example'));
    }

    public function testCustomPathFailed()
    {
        $this->expectException(FileNotFoundException::class);

        $this->artisan('env:sync', ['--path' => base_path('foo')])->run();
    }

    protected function getEnvironmentSetUp($app)
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $app['config'];

        $config->set('env-sync', $this->config());
    }
}
