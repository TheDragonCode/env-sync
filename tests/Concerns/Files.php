<?php

namespace Tests\Concerns;

trait Files
{
    protected $type = 'native';

    protected $fixture_expected = 'expected';

    protected $path = __DIR__ . '/../fixtures/source';

    protected $filename = '.env.example';

    protected function expected(): string
    {
        return realpath(__DIR__ . '/../fixtures/' . $this->type . '/' . $this->fixture_expected);
    }

    protected function targetPath(): string
    {
        return realpath($this->path) . DIRECTORY_SEPARATOR . $this->filename;
    }
}
