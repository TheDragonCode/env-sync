<?php

namespace Tests\Symfony;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\Cases\SymfonyTestCase;

final class MainTest extends SymfonyTestCase
{
    protected $type = 'symfony';

    public function testCustomPath()
    {
        $result = $this->call('env:sync', ['--path' => $this->path]);

        $this->assertStringContainsString('Searching...', $result);
        $this->assertStringContainsString('The found keys were successfully saved to the .env.example file.', $result);

        $this->assertFileExists($this->targetPath());
        $this->assertFileEquals($this->expected(), $this->targetPath());
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->call('env:sync', ['--path' => __DIR__ . '/foo']);
    }
}
