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

            case $this->isNumeric($value):
                return $value;

            case $this->isString($value):
                return $this->fromString($value);

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

    public function fromBool(bool $value): string
    {
        return Boolean::convertToString($value);
    }

    public function fromString(string $value): string
    {
        if (Str::contains($value, [' ', '#'])) {
            return sprintf('"%s"', $value);
        }

        return $value;
    }
}
