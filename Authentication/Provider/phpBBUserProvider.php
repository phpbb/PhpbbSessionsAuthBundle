<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Authentication\Provider;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class phpBBUserProvider implements UserProviderInterface
{
    /**
     * @param $apiKey
     */
    public function getUsernameForApiKey($apiKey)
    {
    }

    /**
     * @param string $username
     * @return UserInterface|void
     */
    public function loadUserByUsername($username)
    {

    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     * @throws UnsupportedUserException
     */
    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return 'phpBB\SessionsAuthBundle\Entity\User' === $class;
    }
}