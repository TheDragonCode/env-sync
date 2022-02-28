<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Boolean;
use DragonCode\Support\Facades\Helpers\Str;

class Stringify
{
    use Makeable;

    public function get($value): string
    {
        switch (true) {
            case $this->isBool($value):
                return $this->fromBool($value);

            case $this->isNull($value):
                return $this->fromNull();

            case $this->isNumeric($value):
            case $this->isString($value):
                return $value;

            default:
                return '';
        }
    }

    public function isBool($value): bool
    {
        return is_bool($value);
    }

    public function isNumeric($value): bool
    {
        return is_numeric($value);
    }

    public function isString($value): bool
    {
        return is_string($value) && ! empty($value);
    }

    public function isNull($value): bool
    {
        return is_null($value) || (is_string($value) && Str::lower($value) === 'null');
    }

    public function fromBool(bool $value): string
    {
        return Boolean::convertToString($value);
    }

    public function fromNull(): string
    {
        return '';
    }
}
