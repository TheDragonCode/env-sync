<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\EnvSync\Support\Config;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Instance;
use DragonCode\Support\Facades\Helpers\OS;
use DragonCode\Support\Facades\Helpers\Str;

class Compiler
{
    use Makeable;

    protected $hides = ['CLIENT', 'HOOK', 'KEY', 'LOGIN', 'PASS', 'SECRET', 'TOKEN', 'USER'];

    protected $unix_separator = "\n";

    protected $windows_separator = "\r\n";

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
     * @param  array|\DragonCode\EnvSync\Support\Config  $config
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

        $separator = $this->getSeparator();

        foreach ($this->items as $values) {
            foreach ($values as $key => $value) {
                $result .= "{$key}={$value}{$separator}";
            }

            $result .= $separator;
        }

        return trim($result) . $separator;
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

    protected function getSeparator(): string
    {
        return OS::isWindows()
            ? $this->windows_separator
            : $this->unix_separator;
    }
}
