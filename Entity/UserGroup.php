<?php
/**
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 */

namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'user_group')]
#[ORM\Entity(readOnly: true)]
class UserGroup
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\Column(name: 'group_id')]
    private ?int $groupId = null;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'groups')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    private $user;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'group_leader')]
    private ?bool $groupLeader = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_pending')]
    private ?bool $userPending = null;

    /**
     * @param int $groupId
     *
     * @return UserGroup
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $user
     *
     * @return UserGroup
     */
    public function setUser($user)
    {
        $this->userId = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param bool $groupLeader
     *
     * @return UserGroup
     */
    public function setGroupLeader($groupLeader)
    {
        $this->groupLeader = $groupLeader;

        return $this;
    }

    /**
     * @return bool
     */
    public function getGroupLeader()
    {
        return $this->groupLeader;
    }

    /**
     * @param bool $userPending
     *
     * @return UserGroup
     */
    public function setUserPending($userPending)
    {
        $this->userPending = $userPending;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUserPending()
    {
        return $this->userPending;
    }
}
