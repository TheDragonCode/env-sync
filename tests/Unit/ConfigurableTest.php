<?php

namespace Tests\Unit;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\TestCase;

final class ConfigurableTest extends TestCase
{
    protected $fixture_expected = 'expected-config';

    public function testContent()
    {
        $service = $this->service();

        $service->path($this->path);
        $service->filename($this->filename);

        $this->assertStringEqualsFile($this->expected(), $service->content());
    }

    public function testStoring()
    {
        $service = $this->service();

        $service->path($this->path);
        $service->filename($this->filename);

        $service->store();

        $this->assertFileExists($this->targetPath());
        $this->assertFileEquals($this->expected(), $this->targetPath());
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->service()->path('foo/bar/baz');
    }

    protected function serviceConfig(): array
    {
        return $this->config();
    }
}
