<?php

namespace Tests\Unit;

use DragonCode\Support\Exceptions\DirectoryNotFoundException;
use DragonCode\Support\Facades\Filesystem\File;
use Tests\TestCase;

class MainTest extends TestCase
{
    public function testRaw()
    {
        $service = $this->service();

        $service->path($this->path);
        $service->filename($this->filename);

        $expected = File::load(__DIR__ . '/../fixtures/expected/raw.php');

        $this->assertSame($expected, $service->raw());
    }

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
}
