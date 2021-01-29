<?php

namespace Helldar\EnvSync\Concerns;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Finder;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Helldar\EnvSync\Support\Config;
use Symfony\Component\Finder\Finder as SymfonyFinder;

trait Makeable
{
    public static function make(array $config = null): Syncer
    {
        $parser    = static::makeParser();
        $stringify = static::makeStringify();
        $config    = static::makeConfig($config);
        $compiler  = static::makeCompiler($stringify, $config);
        $finder    = static::makeFinder();

        return new Syncer($parser, $compiler, $finder);
    }

    protected static function makeParser(): Parser
    {
        return Parser::make();
    }

    protected static function makeStringify(): Stringify
    {
        return Stringify::make();
    }

    protected static function makeConfig(array $config = null): Config
    {
        return Config::make($config);
    }

    protected static function makeCompiler(Stringify $stringify, Config $config): Compiler
    {
        return Compiler::make($stringify, $config);
    }

    protected static function makeFinder(): Finder
    {
        return Finder::make(SymfonyFinder::create());
    }
}
