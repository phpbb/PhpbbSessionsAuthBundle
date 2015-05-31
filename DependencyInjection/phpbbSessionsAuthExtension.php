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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class phpbbSessionsAuthExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $container->setParameter('phpbb_sessions_auth.database.connection', $config['database']['connection']);
        $container->setParameter('phpbb_sessions_auth.database.prefix', $config['database']['prefix']);
        $container->setParameter('phpbb_sessions_auth.database.cookiename', $config['session']['cookiename']);
        $container->setParameter('phpbb_sessions_auth.database.boardurl', $config['session']['boardurl']);
        $container->setParameter('phpbb_sessions_auth.database.loginpage', $config['session']['loginpage']);


        // Yes, Yes, These defines are needed for Auth (From phpBB)
        define('ACL_NEVER', 0);
        define('ACL_YES', 1);
        define('ACL_NO', -1);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}

