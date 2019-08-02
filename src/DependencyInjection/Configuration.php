<?php

declare(strict_types=1);

namespace Tseguier\HealthCheckBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('tseguier_health_check');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode->children()
            ->scalarNode('date_format')
                ->defaultValue('Y-m-d H:i:s T')
            ->end()
        ->end();

        return $treeBuilder;
    }
}
