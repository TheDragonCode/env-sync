<?php

namespace Tests\Concerns;

trait Files
{
    protected $fixture_expected = 'expected';

    protected $fixture_source = 'source';

    protected function source(): string
    {
        return $this->fixtures('source');
    }

    protected function expected(): string
    {
        return $this->fixtures($this->fixture_expected);
    }

    protected function actual(): string
    {
        return $this->fixtures('actual');
    }

    protected function fixtures(string $filename): string
    {
        return __DIR__ . '/../fixtures/' . $filename;
    }
}
