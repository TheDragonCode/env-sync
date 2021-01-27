<?php

namespace Tests\Concerns;

trait Configurable
{
    protected function config(): array
    {
        return require realpath(__DIR__ . '/../fixtures/config.php');
    }
}
