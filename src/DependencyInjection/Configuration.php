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
            ->values(['encore', 'importmap', 'none'])->defaultValue('encore')
            ->info('How the layouts load the DSFR: the bundle\'s Encore build, the application\'s "dsfr" importmap entrypoint, or not at all.')
            ->end()
            ->booleanNode('form_theme')->defaultTrue()
            ->info('Add the DSFR form theme to the application\'s global form themes.')
            ->end()
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
