<?php

namespace Tests\Symfony;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\Cases\SymfonyTestCase;

final class MainTest extends SymfonyTestCase
{
    protected $type = 'laravel';

    public function testCustomPath()
    {
        $this->call('env:sync', ['--path' => $this->path]);

        $this->assertFileExists($this->targetPath());
        $this->assertFileEquals($this->expected(), $this->targetPath());
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->call('env:sync', ['--path' => base_path('foo')]);
    }
}
