<?php

namespace DragonCode\EnvSync\Support;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;

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
        return Arr::get($this->config, $key, $default);
    }
}
