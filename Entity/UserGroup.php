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
    #[ORM\Id]
    #[ORM\Column(name: 'group_id')]
    private ?int $groupId = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'groups')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    private User $user;

    #[ORM\Column(name: 'group_leader')]
    private ?bool $groupLeader = null;

    #[ORM\Column(name: 'user_pending')]
    private ?bool $userPending = null;

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setGroupLeader(bool $groupLeader): self
    {
        $this->groupLeader = $groupLeader;

        return $this;
    }

    public function getGroupLeader(): ?bool
    {
        return $this->groupLeader;
    }

    public function setUserPending(bool $userPending): self
    {
        $this->userPending = $userPending;

        return $this;
    }

    public function getUserPending(): ?bool
    {
        return $this->userPending;
    }
}
