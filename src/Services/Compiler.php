<?php

namespace Helldar\EnvSync\Services;

use Helldar\EnvSync\Support\Config;
use Helldar\Support\Concerns\Makeable;
use Helldar\Support\Facades\Helpers\Instance;
use Helldar\Support\Facades\Helpers\Str;

final class Compiler
{
    use Makeable;

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
        $this->map();
        $this->split();

        return $this->compile();
    }

    /**
     * @param  array|\Helldar\EnvSync\Support\Config  $config
     *
     * @return $this
     */
    public function setConfig($config): self
    {
        $this->config = Instance::of($config, Config::class) ? $config : Config::make($config);

        return $this;
    }

    protected function map(): void
    {
        foreach ($this->items as $key => &$value) {
            $replaced = $this->replace($key, $value);

            $value = $this->stringify($replaced);
        }
    }

    protected function split(): void
    {
        $items = [];

        foreach ($this->items as $key => $value) {
            $section = $this->section($key);

            $items[$section][$key] = $value;
        }

        $this->items = $items;
    }

    protected function compile(): string
    {
        $result = '';

        foreach ($this->items as $values) {
            foreach ($values as $key => $value) {
                $result .= "{$key}={$value}{$this->separator}";
            }

            $result .= $this->separator;
        }

        return trim($result) . $this->separator;
    }

    protected function replace(string $key, $value)
    {
        return $this->isForceHiding($key) ? null : $this->value($key, $value);
    }

    protected function isForceHiding(string $key): bool
    {
        return $this->inArray($key, $this->hides);
    }

    protected function value(string $key, $value)
    {
        foreach ($this->config->forces() as $force_key => $force_value) {
            if (Str::contains($key, $force_key)) {
                return $force_value;
            }
        }

        return $value;
    }

    protected function stringify($value): string
    {
        return $this->stringify->get($value);
    }

    protected function inArray(string $key, array $array): bool
    {
        return Str::contains($key, $array);
    }

    protected function section(string $key): string
    {
        return Str::before($key, '_');
    }
}
