<?php

namespace Tseguier\HealthCheckBundle\DependencyInjection\Compiler;

use Tseguier\HealthCheckBundle\Controller\HealthCheckController;
use Tseguier\HealthCheckBundle\HealthCheckInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HealthCheckerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(HealthCheckController::class)) {
            return;
        }

        $controller = $container->findDefinition(HealthCheckController::class);
        var_dump("SERVICES");
        foreach (array_keys($container->findTaggedServiceIds(HealthCheckInterface::TAG)) as $service) {
            var_dump("SERVICE", $service);
            $controller->addMethodCall('addHealthService', [new Reference($service)]);
        }
    }
}
