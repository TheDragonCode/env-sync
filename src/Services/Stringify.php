<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Boolean;
use DragonCode\Support\Facades\Helpers\Str;

class Stringify
{
    use Makeable;

    public function parse($value): mixed
    {
        return match (true) {
            $this->isNull($value)    => null,
            $this->isBool($value)    => $this->toBool($value),
            $this->isNumeric($value) => $this->toNumeric($value),
            $this->isString($value)  => $value,
            default                  => '',
        };
    }

    public function toString($value): string
    {
        return match (true) {
            $this->isBool($value)    => $this->fromBool($value),
            $this->isNumeric($value) => $value,
            $this->isString($value)  => $this->fromString($value),
            default                  => '',
        };
    }

    protected function isNull($value): bool
    {
        $val = is_string($value) ? Str::lower($value) : $value;

        return is_null($value) || $val === 'null';
    }

    protected function isBool($value): bool
    {
        $val = is_string($value) ? Str::lower($value) : $value;

        return is_bool($value) || $val === 'true' || $val === 'false';
    }

    protected function isNumeric($value): bool
    {
        return is_numeric($value);
    }

    protected function toNumeric($value): float|int
    {
        if (is_float($value)) {
            return (float) $value;
        }

        return (int) $value;
    }

    protected function isString($value): bool
    {
        return is_string($value) && ! empty($value);
    }

    protected function fromBool($value): string
    {
        $parsed = Boolean::parse($value);

        return Boolean::toString($parsed);
    }

    protected function toBool($value): bool
    {
        return Boolean::to($value);
    }

    protected function fromString(string $value): string
    {
        if (Str::contains($value, [' ', '#'])) {
            return sprintf('"%s"', $value);
        }

        return $value;
    }
}
