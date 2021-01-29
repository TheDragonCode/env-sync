<?php

namespace Tests\Symfony;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\Cases\SymfonyTestCase;

final class ConfigurableTest extends SymfonyTestCase
{
    protected $type = 'symfony';

    protected $fixture_expected = 'expected-config';

    public function testCustomPath()
    {
        $this->call('env:sync', ['--path' => $this->path]);

        $this->assertFileExists($this->targetPath());
        $this->assertFileEquals($this->expected(), $this->targetPath());
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->call('env:sync', ['--path' => '/foo']);
    }

    protected function getSyncConfig(): ?array
    {
        return $this->config();
    }
}
