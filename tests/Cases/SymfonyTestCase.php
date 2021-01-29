<?php

namespace Tests\Cases;

use PHPUnit\Framework\TestCase;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class SymfonyTestCase extends TestCase
{
    use Configurable;
    use Files;

    protected function call(string $command, array $options = []): void
    {
        //
    }
}
