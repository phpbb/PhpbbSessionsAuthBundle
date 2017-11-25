<?php

/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Security;

use Doctrine\Common\Persistence\ManagerRegistry;
use phpBB\SessionsAuthBundle\Entity\Session;
use phpBB\SessionsAuthBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class PhpbbUserProvider implements UserProviderInterface
{
    /**
     * @var EntityManager
     * @access private
     */
    private $entityManager;

    /**
     * @var array
     * @access private
     */
    private $roles = [];

    /**
     * @param EntityManager $entityManager
     * @param string $entity
     */
    public function __construct(ManagerRegistry $managerRegistry, $entity)
    {
        $this->entityManager = $managerRegistry->getManager($entity);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param $apiKey
     */
    public function getUsernameForSessionId($sessionId, $expectedUserId, $userIp)
    {
        if (!$sessionId) {
            return null;
        }

        $session = $this
            ->entityManager
            ->getRepository(Session::class)
            ->createQueryBuilder('s')
            ->select('s, u')
            ->join('s.user', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $expectedUserId)
            ->orderBy('s.time', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if ( //check if have session and cookie ip (v6 or v4) are equal to session id
            !$session
            || (
                strpos($session->getIp(), ':') !== false
                && strpos($userIp, ':') !== false
                && $this->shortIpv6($session->getIp(), 3) !== $this->shortIpv6($userIp, 3)
            )
            || substr($session->getIp(), 0, strrpos($session->getIp(), '.')) !== substr($userIp, 0, strrpos($userIp, '.'))
        ) {
            return null;
        }

        //update session time each minute like phpBB does
        $now = time();
        if($now - $session->getTime() >= 60) {
            $session->setTime($now);
            $this->entityManager->flush();
        }

        return $session->getUser()->getUsername();
    }

    /**
     * @param string $username
     * @return UserInterface|void
     */
    public function loadUserByUsername($username)
    {
        $user = $this
            ->entityManager
            ->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('u, ug')
            ->join('u.groups', 'ug')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();

        $roles = [];
        foreach ($user->getGroups() as $group) {
            if (!isset($this->roles[$group->getGroupId()])) {
                throw new \Exception("Roles provided in configuration don't have id ".$group->getGroupId(), 1);
            }
            $roles[$group->getGroupId()] = 'ROLE_'.strtoupper($this->roles[$group->getGroupId()]);
        }
        uksort($roles, function($a, $b) use ($user) { return $a <> $user->getGroupId(); });
        return $user->setRoles($roles);
    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     */
    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }

    /**
     * Returns the first block of the specified IPv6 address and as many additional
     * ones as specified in the length paramater.
     * If length is zero, then an empty string is returned.
     * If length is greater than 3 the complete IP will be returned
     *
     * @copyright (c) phpBB Limited <https://www.phpbb.com>
     * @license GNU General Public License, version 2 (GPL-2.0)
     *
     * @param string $ip
     * @param integer $length
     * @return mixed|string
     */
    private function shortIpv6($ip, $length)
    {
        if ($length < 1) {
            return '';
        }

        // extend IPv6 addresses
        $blocks = substr_count($ip, ':') + 1;
        if ($blocks < 9) {
            $ip = str_replace('::', ':' . str_repeat('0000:', 9 - $blocks), $ip);
        } elseif ($ip[0] == ':') {
            $ip = '0000' . $ip;
        } elseif ($length < 4) {
            $ip = implode(':', array_slice(explode(':', $ip), 0, 1 + $length));
        }
        return $ip;
    }
}
