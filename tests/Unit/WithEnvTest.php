<?php

declare(strict_types=1);

namespace Tests\Unit;

use DragonCode\Support\Facades\Filesystem\File;
use Tests\TestCase;

class WithEnvTest extends TestCase
{
    protected string $fixture_expected = 'expected-sync';

    protected string $filename = '.env';

    public function testSync()
    {
        $this->copyFixture();

        $service = $this->service();

        $service->path($this->path);
        $service->filename($this->filename, true);

        $service->store();

        $this->assertFileExists($this->targetPath());
        $this->assertFileEquals($this->expected(), $this->targetPath());
    }

    protected function copyFixture()
    {
        File::copy($this->path . '/.env.sync', $this->targetPath());
    }
}
