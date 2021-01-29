<?php

namespace Tests\Cases;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class SymfonyTestCase extends KernelTestCase
{
    use Configurable;
    use Files;

    protected function call(string $name, array $options = []): string
    {
        $command = $this->application()->find($name);

        $tester = $this->tester($command);

        $tester->execute($options);

        return $tester->getDisplay();
    }

    protected function application(): Application
    {
        return new Application($this->kernel());
    }

    protected function kernel(): KernelInterface
    {
        return static::createKernel();
    }

    protected function tester(Command $command): CommandTester
    {
        return new CommandTester($command);
    }
}
