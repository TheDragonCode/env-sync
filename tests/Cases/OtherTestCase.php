<?php

namespace Tests\Cases;

use PHPUnit\Framework\TestCase;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class OtherTestCase extends TestCase
{
    use Configurable;
    use Files;
}
