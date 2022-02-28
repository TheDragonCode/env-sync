<?php

interface Bar
{
    public function get(string $key, $default = null);
}

class Foo
{
    function first()
    {
        $this->accessToken = $token ?? getenv(static::BOT_TOKEN_ENV_NAME);
    }

    public function get(string $key, $default = null)
    {
        @putenv('LINES='.$this->terminal->getHeight());
        @putenv('COLUMNS='.$this->terminal->getWidth());
        @putenv('SHELL_VERBOSITY='.$shellVerbosity);

        putenv("{$name}={$value}");

        $_ENV['SHELL_VERBOSITY'] = $shellVerbosity;
        $_SERVER['SHELL_VERBOSITY'] = $shellVerbosity;

        $arr = [
            'kernel.runtime_environment' => '%env(default:kernel.environment:APP_RUNTIME_ENV)%',
        ];
    }
}
