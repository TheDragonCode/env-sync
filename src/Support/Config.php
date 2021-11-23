<?php

namespace DragonCode\EnvSync\Support;

use DragonCode\Support\Concerns\Makeable;

class Config
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
