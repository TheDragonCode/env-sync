<?php

namespace Tests\Concerns;

trait Files
{
    protected $fixture_expected = 'expected';

    protected $path = __DIR__ . '/../fixtures/source';

    protected $filename = '.env.example';

    protected function expected(?string $path = null): string
    {
        $filename = $path ?: $this->fixture_expected;

        return realpath(__DIR__ . '/../fixtures/expected/' . $filename);
    }

    protected function targetPath(): string
    {
        return realpath($this->path) . DIRECTORY_SEPARATOR . $this->filename;
    }
}
