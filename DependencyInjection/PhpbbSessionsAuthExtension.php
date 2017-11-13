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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use phpBB\SessionsAuthBundle\Security\PhpbbUserProvider;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PhpbbSessionsAuthExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('phpbb_sessions_auth.database.entity_manager', $config['database']['entity_manager']);
        $container->setParameter('phpbb_sessions_auth.database.prefix', $config['database']['prefix']);
        $container->setParameter('phpbb_sessions_auth.session.cookie_name', $config['session']['cookie_name']);
        $container->setParameter('phpbb_sessions_auth.session.login_page', $config['session']['login_page']);
        $container->setParameter('phpbb_sessions_auth.session.force_login', $config['session']['force_login']);
        $container->setParameter('phpbb_sessions_auth.roles', $config['roles']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
