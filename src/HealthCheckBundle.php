<?php

declare(strict_types=1);

namespace Tseguier\HealthCheckBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class HealthCheckBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->registerForAutoconfiguration(HealthCheckInterface::class)->addTag(HealthCheckInterface::TAG);
    }
}
