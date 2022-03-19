<?php

declare(strict_types=1);

namespace DragonCode\EnvSync\Services;

use Dotenv\Dotenv;
use DragonCode\Support\Concerns\Makeable;
use RuntimeException;

class Reader
{
    use Makeable;

    public function from(string $path): array
    {
        if (! file_exists($path)) {
            throw new RuntimeException('Env file does not exist.');
        }

        return $this->load($path);
    }

    protected function load(string $path): array
    {
        $content = $this->getContent($path);

        return $this->parse($content);
    }

    protected function getContent(string $path): string
    {
        return file_get_contents($path);
    }

    protected function parse(string $content): array
    {
        return Dotenv::parse($content);
    }
}
