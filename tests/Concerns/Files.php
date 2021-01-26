<?php

namespace Tests\Concerns;

trait Files
{
    protected function source(): string
    {
        return __DIR__ . '/../fixtures/source';
    }

    protected function expected(): string
    {
        return __DIR__ . '/../fixtures/expected';
    }
}
