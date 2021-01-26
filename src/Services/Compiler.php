<?php

namespace Helldar\EnvSync\Services;

use Helldar\Support\Facades\Helpers\Str;

final class Compiler
{
    protected $keeping = ['APP_NAME'];

    protected $forces = [
        'APP_ENV'   => 'production',
        'APP_DEBUG' => false,
        'APP_URL'   => 'http://localhost',

        'LOG_CHANNEL' => 'daily',

        'DB_CONNECTION' => 'mysql',
        'DB_HOST'       => '127.0.0.1',
        'DB_PORT'       => 3306,
        'DB_DATABASE'   => 'default',

        'BROADCAST_DRIVER' => 'redis',
        'CACHE_DRIVER'     => 'redis',
        'QUEUE_CONNECTION' => 'redis',
        'SESSION_DRIVER'   => 'redis',
        'SESSION_LIFETIME' => 120,

        'REDIS_HOST' => '127.0.0.1',
        'REDIS_PORT' => 6379,

        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST'   => 'mailhog',
        'MAIL_PORT'   => 1025,
    ];

    protected $separator = "\n";

    protected $stringify;

    protected $items;

    public function __construct(Stringify $stringify)
    {
        $this->stringify = $stringify;
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
        if ($this->isKeeping($key)) {
            return $value;
        }

        return $this->value($key);
    }

    protected function isKeeping(string $key): bool
    {
        return in_array($key, $this->keeping);
    }

    protected function value(string $key)
    {
        foreach ($this->forces as $forced_key => $value) {
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
}
