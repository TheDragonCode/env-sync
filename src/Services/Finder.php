<?php

namespace DragonCode\EnvSync\Services;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;
use Symfony\Component\Finder\Finder as SymfonyFinder;

class Finder
{
    use Makeable;

    public const CONTAINS = ['env(', 'getenv('];

    protected array $exclude_dirs = ['node_modules', '.idea', '.git', '.github', 'tests'];

    protected array $names = ['*.php', '*.json', '*.yml', '*.yaml', '*.twig'];

    protected array $files = [];

    public function __construct(
        protected SymfonyFinder $finder
    ) {}

    /**
     * @param  string|array<string>  $path
     */
    public function get(array|string $path): array
    {
        $this->search($path);

        return $this->files();
    }

    /**
     * @param  string|array<string>  $path
     */
    protected function search(array|string $path): void
    {
        foreach ($this->find($path) as $file) {
            $this->push($file->getRealPath());
        }
    }

    /**
     * @param  string|array<string>  $path
     */
    protected function find(array|string $path): SymfonyFinder
    {
        return $this->finder->in($path)->files()
            ->exclude($this->exclude_dirs)
            ->name($this->names)
            ->contains(self::CONTAINS);
    }

    protected function push(string $path): void
    {
        $this->files[] = $path;
    }

    protected function files(): array
    {
        return Arr::sort($this->files);
    }
}
