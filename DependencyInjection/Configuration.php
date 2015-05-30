<?php
/**
 * 
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 * @author Unknown Bliss
 * 
 */

namespace phpBB\SessionsAuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('phpbb_sessions_auth');
        $rootNode->children()
                    ->arrayNode('session')->isRequired()
                        ->children()
                            ->booleanNode('secure')->defaultFalse()->isRequired()->end()
                            ->scalarNode('cookiename')->isRequired()->end()
                            ->scalarNode('boardpath')->isRequired()->end()
                        ->end()
                    ->end()
                    ->arrayNode('database')
                        ->children()
                            ->scalarNode('connection')->isRequired()->end()
                            ->scalarNode('prefix')->isRequired()->end()
                    ->end()
                ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}

