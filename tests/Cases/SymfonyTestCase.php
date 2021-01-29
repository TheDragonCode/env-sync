<?php

namespace Tests\Cases;

use Composer\Config;
use Helldar\EnvSync\Frameworks\Symfony\Console\Sync;
use Helldar\EnvSync\Services\Syncer;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Kernel;
use Tests\Concerns\Configurable;
use Tests\Concerns\Files;

abstract class SymfonyTestCase extends TestCase
{
    use Configurable;
    use Files;

    /** @var \Symfony\Component\DependencyInjection\ContainerInterface|\PHPUnit\Framework\MockObject\MockObject */
    protected $container;

    /** @var \Symfony\Bundle\FrameworkBundle\Console\Application */
    protected $application;

    protected function setUp(): void
    {
        $this->mockContainer();
        $this->mockApplication();
        $this->mockCommand();
    }

    protected function mockContainer(): void
    {
        $this->container = $this->getMockBuilder(ContainerInterface::class)->getMock();
    }

    /**
     * @return \Symfony\Component\HttpKernel\Kernel|\PHPUnit\Framework\MockObject\MockBuilder
     */
    protected function mockKernel()
    {
        $kernel = $this->getMockBuilder(Kernel::class)
            ->disableOriginalConstructor()
            ->getMock();

        $kernel->expects($this->once())
            ->method('getBundles')
            ->will($this->returnValue([]));

        $kernel->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($this->container));

        return $kernel;
    }

    protected function mockApplication(): void
    {
        $this->application = new Application($this->mockKernel());
    }

    protected function mockCommand(): void
    {
        $command = $this->getCommand();

        $this->application->add($command);
    }

    protected function composerConfig(): Config
    {
        return new Config();
    }

    protected function getSyncer(): Syncer
    {
        return Syncer::make();
    }

    protected function getCommand(): Sync
    {
        return new Sync($this->composerConfig(), $this->getSyncer());
    }

    protected function tester(Command $command): CommandTester
    {
        return new CommandTester($command);
    }

    protected function call(string $name, array $options = [])
    {
        $command = $this->application->find($name);

        $tester = $this->tester($command);

        $tester->execute(array_merge(['command' => $name], $options));

        return $tester->getDisplay();
    }
}
