<?php

namespace Urg\ShopfyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('urg_shopfy');
        
        $rootNode
            ->children() 
                ->scalarNode('api_key')->end()
                ->scalarNode('password')->end()
                ->scalarNode('shared_secret')->end()
                ->scalarNode('domain')->end() 
                ->arrayNode('scope')
                    ->prototype('scalar')->end()
                ->end()
            ->end()    
        ->end();

        return $treeBuilder;
    }
}
