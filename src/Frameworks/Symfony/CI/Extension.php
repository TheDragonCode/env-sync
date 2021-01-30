<?php

namespace Helldar\EnvSync\Frameworks\Symfony\CI;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension as BaseExtension;

/**
 * @deprecated Starting with version 2.0, this functionality will be moved to the andrey-helldar/env-sync-symfony package.
 */
class Extension extends BaseExtension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loader($container)->load('env-sync.xml');
    }

    protected function loader(ContainerBuilder $container): XmlFileLoader
    {
        return new XmlFileLoader($container, $this->locator());
    }

    protected function locator(): FileLocator
    {
        return new FileLocator($this->configPath());
    }

    protected function configPath(): string
    {
        return realpath(__DIR__ . '/../../../config');
    }
}
