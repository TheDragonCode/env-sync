<?php

namespace Tests\Concerns;

trait Files
{
    protected function source(): string
    {
        return $this->fixtures('source');
    }

    protected function expected(bool $config = false): string
    {
        $filename = $config ? 'expected-config' : 'expected';

        return $this->fixtures($filename);
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
