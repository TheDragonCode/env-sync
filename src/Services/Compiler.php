<?php

namespace Helldar\EnvSync\Services;

use Helldar\EnvSync\Support\Config;
use Helldar\Support\Facades\Helpers\Str;

final class Compiler
{
    protected $hides = ['CLIENT', 'HOOK', 'KEY', 'LOGIN', 'PASS', 'SECRET', 'TOKEN', 'USER'];

    protected $separator = "\n";

    protected $stringify;

    protected $config;

    protected $items;

    public function __construct(Stringify $stringify, Config $config)
    {
        $this->stringify = $stringify;
        $this->config    = $config;
    }

    public function items(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function get(): string
    {
        foreach ($this->items as $key => &$value) {
            if ($this->isEmptyRow($key, $value)) {
                continue;
            }

            $replaced = $this->replace($key, $value);

            $value = $this->stringify($replaced);
        }

        return $this->compile();
    }

    protected function replace(string $key, $value)
    {
        switch (true) {
            case $this->isForceHiding($key):
                return null;

            case $this->isKeeping($key):
                return $value;

            default:
                return $this->value($key);
        }
    }

    protected function isKeeping(string $key): bool
    {
        return $this->inArray($key, $this->config->keep());
    }

    protected function isForceHiding(string $key): bool
    {
        return $this->inArray($key, $this->hides);
    }

    protected function value(string $key)
    {
        foreach ($this->config->forces() as $forced_key => $value) {
            if (Str::endsWith($key, $forced_key)) {
                return $value;
            }
        }

        return null;
    }

    protected function stringify($value): string
    {
        return $this->stringify->get($value);
    }

    protected function compile(): string
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            if ($this->isEmptyRow($key, $value)) {
                $result[] = '';

                continue;
            }

            $result[] = $key . '=' . $value;
        }

        return implode($this->separator, $result);
    }

    protected function isEmptyRow($key, $value): bool
    {
        return is_numeric($key) && empty($value);
    }

    protected function inArray(string $key, array $array): bool
    {
        return Str::contains($key, $array);
    }
}
