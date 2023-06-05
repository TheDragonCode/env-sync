<?php

namespace Tests;

use DragonCode\EnvSync\Services\Syncer;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class TestCase extends BaseTestCase
{
    use Configurable;

    use Files;

    protected function service(): Syncer
    {
        return Syncer::make($this->serviceConfig());
    }

    protected function serviceConfig(): array
    {
        return [];
    }
}
