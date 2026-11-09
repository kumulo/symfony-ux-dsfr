<?php

declare(strict_types=1);

namespace SymfonyUxDsfr\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dsfr');

        $treeBuilder->getRootNode()
            ->children()
            ->enumNode('dsfr_integration_mode')
            ->values(['encore', 'importmap', 'none'])->defaultValue('encore')->end()
            ->arrayNode('search')
            ->children()
            ->scalarNode('form_action')->end()
            ->scalarNode('form_method')->end()
            ->scalarNode('input_name')->defaultValue('search')->end()
            ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
