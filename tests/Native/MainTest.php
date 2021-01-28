<?php

namespace Tests\Native;

use Helldar\Support\Exceptions\DirectoryNotFoundException;
use Tests\Cases\NativeTestCase;

final class MainTest extends NativeTestCase
{
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

        $path = $this->path . '/' . $this->filename;

        $this->assertFileExists($path);
        $this->assertFileEquals($this->expected(), $path);
    }

    public function testCustomPathFailed()
    {
        $this->expectException(DirectoryNotFoundException::class);

        $this->service()->path('foo/bar/baz');
    }
}
