<?php

namespace Helldar\EnvSync\Services;

use Helldar\Support\Facades\Helpers\Filesystem\File;

final class Syncer
{
    protected $compiler;

    protected $parser;

    protected $from;

    protected $to;

    public function __construct(Parser $parser, Compiler $compiler)
    {
        $this->parser   = $parser;
        $this->compiler = $compiler;
    }

    public function from(string $path): self
    {
        File::validate($path);

        $this->from = $path;

        return $this;
    }

    public function to(string $path): self
    {
        $this->to = $path;

        return $this;
    }

    public function cleaned(): string
    {
        $items = $this->parser->raw($this->content())->get();

        return $this->compiler->items($items)->get();
    }

    public function store(): void
    {
        File::store($this->to, $this->cleaned());
    }

    protected function content(): string
    {
        return file_get_contents($this->from);
    }
}
