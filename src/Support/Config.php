<?php

namespace Helldar\EnvSync\Support;

final class Config
{
    /** @var array */
    protected $config;

    public function __construct(array $config = null)
    {
        $this->config = $config ?: $this->load();
    }

    public function keep(): array
    {
        return $this->get('keep', []);
    }

    public function forces(): array
    {
        return $this->get('forces', []);
    }

    protected function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    protected function load(): array
    {
        return require realpath(__DIR__ . '/../../config/env-sync.php');
    }
}
