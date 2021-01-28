<?php

namespace Tests\Concerns;

trait Files
{
    protected $type = 'native';

    protected $fixture_expected = 'expected';

    protected function expected(): string
    {
        return realpath(__DIR__ . '/../fixtures/' . $this->type . '/' . $this->fixture_expected);
    }
}
