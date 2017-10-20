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

        $entityManager = new Reference(sprintf('doctrine.orm.%s_entity_manager', $config['database']['entity_manager']));

        // $container->setParameter('phpbb_sessions_auth.database.entity_manager', $entityManager);
        $container->setParameter('phpbb_sessions_auth.database.prefix', $config['database']['prefix']);
        $container->setParameter('phpbb_sessions_auth.session.cookiename', $config['session']['cookiename']);
        $container->setParameter('phpbb_sessions_auth.session.boardurl', $config['session']['boardurl']);
        $container->setParameter('phpbb_sessions_auth.session.loginpage', $config['session']['loginpage']);
        $container->setParameter('phpbb_sessions_auth.session.force_login', $config['session']['force_login']);


        // Yes, Yes, These defines are needed for Auth (From phpBB)
        define('ACL_NEVER', 0);
        define('ACL_YES', 1);
        define('ACL_NO', -1);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->getDefinition('phpbb.sessionsauthbundle.phpbb_authenticator')
            ->addMethodCall('setEntityManager', [$entityManager]);


        $container->setDefinition(
            'phpbb.sessionsauthbundle.phpbb_user_provider',
            new Definition(
                'phpBB\SessionsAuthBundle\Authentication\Provider\phpBBUserProvider',
                [$entityManager]
            )
        );
    }
}

