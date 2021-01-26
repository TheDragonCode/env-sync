<?php

namespace Helldar\EnvSync\Services;

final class Stringify
{
    public function get($value): string
    {
        switch (true) {
            case $this->isBool($value):
                return $this->fromBool($value);

            case $this->isNumeric($value):
            case $this->isString($value):
                return $value;

            default:
                return 'null';
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
        return $value ? 'true' : 'false';
    }
}
