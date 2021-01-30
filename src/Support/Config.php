<?php

namespace Helldar\EnvSync\Support;

use Helldar\Support\Concerns\Makeable;

final class Config
{
    use Makeable;

    /** @var array */
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function forces(): array
    {
        return $this->get('forces', []);
    }

    protected function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }
}
