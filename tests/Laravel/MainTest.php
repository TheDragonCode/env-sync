<?php

namespace Tests\Laravel;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\Cases\LaravelTestCase;

final class MainTest extends LaravelTestCase
{
    protected $type = 'laravel';

    public function testCommand()
    {
        $this->artisan('env:sync')->assertExitCode(0)->run();

        $this->assertFileExists(base_path('.env.example'));
        $this->assertFileEquals($this->expected(), base_path('.env.example'));
    }

    public function testCustomPath()
    {
        $this->artisan('env:sync', ['--path' => base_path()])
            ->assertExitCode(0)
            ->run();

        $this->assertFileExists(base_path('.env.example'));
        $this->assertFileEquals($this->expected(), base_path('.env.example'));
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->artisan('env:sync', ['--path' => base_path('foo')])->run();
    }
}
