<?php

namespace Tests\Other;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Helldar\EnvSync\Support\Config;
use Tests\Cases\OtherTestCase;

final class MainTest extends OtherTestCase
{
    public function testContent()
    {
        $service = $this->service();

        $service->from($this->source());

        $this->assertStringEqualsFile($this->expected(), $service->cleaned());
    }

    public function testStoring()
    {
        $service = $this->service();

        $service->from($this->source());
        $service->to($this->actual());

        $service->store();

        $this->assertFileExists($this->actual());
        $this->assertFileEquals($this->expected(), $this->actual());
    }

    protected function service(): Syncer
    {
        $parser    = new Parser();
        $stringify = new Stringify();
        $config    = new Config();
        $compiler  = new Compiler($stringify, $config);

        return new Syncer($parser, $compiler);
    }
}
