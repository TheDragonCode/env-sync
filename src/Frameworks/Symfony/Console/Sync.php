<?php

namespace Helldar\EnvSync\Frameworks\Symfony\Console;

use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Finder;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;
use Helldar\EnvSync\Support\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder as SymfonyFinder;

final class Sync extends Command
{
    /** @var \Symfony\Component\Console\Input\InputInterface */
    protected $input;

    /** @var \Symfony\Component\Console\Output\OutputInterface */
    protected $output;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;

        $this->info('Searching...');

        $filename = $this->filename();

        $this->sync($filename);

        $this->info("The found keys were successfully saved to the {$filename} file.");
    }

    protected function configure()
    {
        $this
            ->setName('env:sync')
            ->setDescription('Synchronizing environment settings with a preset')
            ->addOption('path', InputArgument::OPTIONAL, 'Gets the path to scan for files');
    }

    protected function sync(string $filename): void
    {
        $this->syncer()
            ->path($this->path())
            ->filename($filename)
            ->store();
    }

    protected function path(): string
    {
        return $this->optionPath() ?: $this->realPath();
    }

    protected function filename(): string
    {
        return '.env.example';
    }

    protected function optionPath(): ?string
    {
        return $this->input->getOption('path');
    }

    protected function realPath(): string
    {
        return realpath(base_path());
    }

    protected function syncer(): Syncer
    {
        $parser    = new Parser();
        $stringify = new Stringify();
        $config    = new Config();
        $compiler  = new Compiler($stringify, $config);
        $finder    = new Finder(SymfonyFinder::create());

        return new Syncer($parser, $compiler, $finder);
    }

    protected function info(string $message): void
    {
        $this->line($message, 'info');
    }

    protected function line(string $string, string $style = null)
    {
        $styled = $style ? "<$style>$string</$style>" : $string;

        $this->output->writeln($styled);
    }
}
