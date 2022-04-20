<?php

namespace DragonCode\EnvSync\Support;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;

class Config
{
    use Makeable;

    public function __construct(
        protected array $config = []
    ) {
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
