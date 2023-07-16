<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\EnvSync\Support\Config;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Str;
use DragonCode\Support\Facades\Instances\Instance;

class Compiler
{
    use Makeable;

    protected array $hides = ['CLIENT', 'HOOK', 'KEY', 'LOGIN', 'PASS', 'SECRET', 'TOKEN', 'USER'];

    protected string $separator = PHP_EOL;

    protected array $items = [];

    public function __construct(
        protected Stringify $stringify,
        protected Config $config
    ) {}

    public function items(array $items, array $target = [], bool $secure = true): self
    {
        $filtered = $this->filter($items, $target);

        $this->items = $this->map($filtered, $secure);

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function get(): string
    {
        $items = $this->grouped();

        return $this->compile($items);
    }

    public function setConfig(array|Config $config): self
    {
        $this->config = Instance::of($config, Config::class) ? $config : Config::make($config);

        return $this;
    }

    protected function filter(array $items, array $target): array
    {
        if (! empty($target)) {
            return array_intersect_key($target, $items);
        }

        return $items;
    }

    protected function map(array $items, bool $secure): array
    {
        $result = [];

        foreach ($items as $key => $value) {
            $key = Str::upper($key);

            $replaced = $this->replace($key, $value, $secure);

            $result[$key] = $this->parseStringValue($replaced);
        }

        return $result;
    }

    protected function grouped(): array
    {
        $result = [];

        foreach ($this->getItems() as $key => $value) {
            $section = $this->section($key);
            $key     = $this->key($key);

            $result[$section][$key] = $value;
        }

        return $result;
    }

    protected function compile(array $items): string
    {
        $result = '';

        $separator = $this->getSeparator();

        foreach ($items as $values) {
            foreach ($values as $key => $value) {
                $string = $this->compileString($value);

                $result .= "{$key}={$string}{$separator}";
            }

            $result .= $separator;
        }

        return trim($result) . $separator;
    }

    protected function replace(string $key, $value, bool $secure)
    {
        if ($this->isForceHiding($key) && $secure) {
            return;
        }

        return $secure ? $this->value($key, $value) : $value;
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

    protected function parseStringValue($value)
    {
        return $this->stringify->parse($value);
    }

    protected function compileString($value): string
    {
        return $this->stringify->toString($value);
    }

    protected function inArray(string $key, array $array): bool
    {
        return Str::contains($key, $array);
    }

    protected function section(string $key): string
    {
        return (string) Str::of($key)->before('_')->upper();
    }

    protected function key(string $key): string
    {
        return Str::upper($key);
    }

    protected function getSeparator(): string
    {
        return $this->separator;
    }
}
