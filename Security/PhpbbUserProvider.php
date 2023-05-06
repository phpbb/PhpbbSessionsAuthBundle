<?php

/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Security;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use phpBB\SessionsAuthBundle\Entity\{Session, SessionKey, User};
use Symfony\Component\Security\Core\User\{UserInterface, UserProviderInterface};

class PhpbbUserProvider implements UserProviderInterface
{
    private EntityManagerInterface $entityManager;
    private array $roles = [];

    public function __construct(Registry $registry, string $entity)
    {
        $this->entityManager = $registry->getManager($entity);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getUserFromSession(string $ip, string $sessionId, int $userId): ?User
    {
        $session = $this
            ->entityManager
            ->getRepository(Session::class)
            ->createQueryBuilder('s')
            ->select('s')
            ->where('s.id = ?0')
            ->andWhere('s.user = ?1')
            ->setParameters([$sessionId, $userId])
            ->orderBy('s.time', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if ( //check if have session and cookie ip (v6 or v4) are equal to session id
            !$session
            || (
                str_contains($session->getIp(), ':')
                && str_contains($ip, ':')
                && $this->shortIpv6($session->getIp(), 3) !== $this->shortIpv6($ip, 3)
            )
            || substr($session->getIp(), 0, strrpos($session->getIp(), '.')) !== substr($ip, 0, strrpos($ip, '.'))
        ) {
            return null;
        }

        //update session time each minute like phpBB does
        $now = time();
        if ($now - $session->getTime() >= 60) {
            $session->setTime($now);
            $this->entityManager->flush();
        }

        return $this->setRolesFromGroups($session->getUser());
    }

    public function checkKey(string $ip, ?string $key, int $userId): bool
    {
        return $this
            ->entityManager
            ->getRepository(SessionKey::class)
            ->createQueryBuilder('s')
            ->select('s.key')
            ->where('s.key = ?0')
            ->andWhere('s.user = ?1')
            ->andWhere('s.lastIp = ?2')
            ->setParameters([$key, $userId, $ip])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult() <> null;
    }

    public function loadUserByUsername(string $username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->setRolesFromGroups($this
            ->entityManager
            ->getRepository(User::class)
            ->createQueryBuilder('u')
            ->select('u, ug')
            ->join('u.groups', 'ug')
            ->where('u.username = :username')
            ->setParameter('username', $identifier)
            ->getQuery()
            ->getOneOrNullResult()
        );
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }

    private function setRolesFromGroups(User $user): User
    {
        $roles = [];
        foreach ($user->getGroups() as $group) {
            if (!isset($this->roles[$group->getGroupId()])) {
                throw new \Exception("Roles provided in configuration don't have id ".$group->getGroupId(), 1);
            }
            $roles[$group->getGroupId()] = 'ROLE_'.strtoupper($this->roles[$group->getGroupId()]);
        }
        uksort($roles, fn($a, $b) => $a <=> $user->getGroupId());
        return $user->setRoles($roles);
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
