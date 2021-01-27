<?php

namespace Tests\Other;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Helldar\EnvSync\Support\Config;
use Tests\Cases\OtherTestCase;

final class ConfigurableTest extends OtherTestCase
{
    public function testContent()
    {
        $service = $this->service();

        $service->from($this->source());

        $this->assertStringEqualsFile($this->expected(true), $service->cleaned());
    }

    public function testStoring()
    {
        $service = $this->service();

        $service->from($this->source());
        $service->to($this->actual());

        $service->store();

        $this->assertFileExists($this->actual());
        $this->assertFileEquals($this->expected(true), $this->actual());
    }

    protected function service(): Syncer
    {
        $parser    = new Parser();
        $stringify = new Stringify();
        $config    = new Config($this->config());
        $compiler  = new Compiler($stringify, $config);

        return new Syncer($parser, $compiler);
    }

    protected function config(): array
    {
        return require realpath(__DIR__ . '/../fixtures/config.php');
    }
}
