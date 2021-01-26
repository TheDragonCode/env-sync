<?php

namespace Tests\Other;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Tests\Cases\OtherTestCase;

final class OtherTest extends OtherTestCase
{
    public function testContent()
    {
        $service = $this->service();

        $service->from(__DIR__ . '/fixtures/source');

        $this->assertStringEqualsFile(__DIR__ . '/fixtures/expected', $service->cleaned());
    }

    public function testStoring()
    {
        $service = $this->service();

        $service->from(__DIR__ . '/fixtures/source');
        $service->to(__DIR__ . '/fixtures/actual');

        $service->store();

        $this->assertFileExists(__DIR__ . '/fixtures/actual');
        $this->assertFileEquals(__DIR__ . '/fixtures/expected', __DIR__ . '/fixtures/actual');
    }

protected function service(): Syncer
{
    $parser    = new Parser();
    $stringify = new Stringify();
    $compiler  = new Compiler($stringify);

    return new Syncer($parser, $compiler);
}
}
