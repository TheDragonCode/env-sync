<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\EnvSync\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Filesystem\Directory;
use DragonCode\Support\Facades\Helpers\Filesystem\File;

class Syncer
{
    use Makeable;

    protected $compiler;

    protected $parser;

    protected $finder;

    protected $path;

    protected $filename;

    protected $sync;

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

    public function filename(string $filename, bool $sync = false): self
    {
        $this->filename = $filename;
        $this->sync     = $sync;

        return $this;
    }

    public function raw(): array
    {
        return $this->prepared()->getItems();
    }

    public function content(): string
    {
        return $this->prepared()->get();
    }

    public function store(): void
    {
        File::store($this->targetPath(), $this->content());
    }

    protected function prepared(): Compiler
    {
        $files = $this->files();

        $items = $this->parsed($files);

        $target = $this->sync ? $this->parser() : [];

        return $this->compiler($items, $target);
    }

    protected function parser(): array
    {
        return Reader::make()->from($this->targetPath());
    }

    protected function files(): array
    {
        return $this->finder->get($this->path);
    }

    protected function parsed(array $files): array
    {
        return $this->parser->files($files)->get();
    }

    protected function compiler(array $items, array $target = []): Compiler
    {
        return $this->compiler->items($items, $target);
    }

    protected function targetPath(): string
    {
        return rtrim($this->path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->filename;
    }
}
