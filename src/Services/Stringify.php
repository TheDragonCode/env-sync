<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Boolean;
use DragonCode\Support\Facades\Helpers\Str;

class Stringify
{
    use Makeable;

    public function parse($value)
    {
        switch (true) {
            case $this->isNull($value):
                return null;

            case $this->isBool($value):
                return $this->toBool($value);

            case $this->isNumeric($value):
                return $this->toNumeric($value);

            case $this->isString($value):
                return $value;

            default:
                return '';
        }
    }

    public function toString($value): string
    {
        switch (true) {
            case $this->isBool($value):
                return $this->fromBool($value);

            case $this->isNumeric($value):
                return $value;

            case $this->isString($value):
                return $this->fromString($value);

            default:
                return '';
        }
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

    protected function toNumeric($value)
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

        return Boolean::convertToString($parsed);
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
