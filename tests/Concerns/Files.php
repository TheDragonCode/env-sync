<?php

namespace Tests\Concerns;

trait Files
{
    protected string $fixture_expected = 'expected';

    protected string $path = __DIR__ . '/../fixtures/source';

    protected string $filename = '.env.example';

    protected function expected(): string
    {
        return realpath(__DIR__ . '/../fixtures/expected/' . $this->fixture_expected);
    }

    protected function targetPath(): string
    {
        return realpath($this->path) . DIRECTORY_SEPARATOR . $this->filename;
    }
}
