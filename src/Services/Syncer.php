<?php

namespace Helldar\EnvSync\Services;

use Helldar\Support\Facades\Helpers\Filesystem\Directory;
use Helldar\Support\Facades\Helpers\Filesystem\File;

final class Syncer
{
    protected $compiler;

    protected $parser;

    protected $finder;

    protected $path;

    protected $filename;

    public function __construct(Parser $parser, Compiler $compiler, Finder $finder)
    {
        $this->parser   = $parser;
        $this->compiler = $compiler;
        $this->finder   = $finder;
    }

    public function path(string $path): self
    {
        Directory::validate($path);

        $this->path = realpath($path);

        return $this;
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function content(): string
    {
        $files = $this->files();

        $items = $this->parsed($files);

        return $this->compiled($items);
    }

    public function store(): void
    {
        File::store($this->storePath(), $this->content());
    }

    protected function files(): array
    {
        return $this->finder->get($this->path);
    }

    protected function parsed(array $files): array
    {
        return $this->parser->files($files)->get();
    }

    protected function compiled(array $items): string
    {
        return $this->compiler->items($items)->get();
    }

    protected function storePath(): string
    {
        return rtrim($this->path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->filename;
    }
}
