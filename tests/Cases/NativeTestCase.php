<?php

namespace Tests\Cases;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Finder;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Helldar\EnvSync\Support\Config;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder as SymfonyFinder;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class NativeTestCase extends TestCase
{
    use Configurable;
    use Files;

    protected function service(): Syncer
    {
        $parser    = new Parser();
        $stringify = new Stringify();
        $config    = new Config($this->serviceConfig());
        $compiler  = new Compiler($stringify, $config);
        $finder    = new Finder(SymfonyFinder::create());

        return new Syncer($parser, $compiler, $finder);
    }

    protected function serviceConfig(): ?array
    {
        return null;
    }
}
