<?php

namespace Helldar\EnvSync\Frameworks\Symfony;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @deprecated Starting with version 2.0, this functionality will be moved to the andrey-helldar/env-sync-symfony package.
 */
final class EnvSyncBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
