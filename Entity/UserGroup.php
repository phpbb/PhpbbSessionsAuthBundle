<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package phpbb\SessionsAuthBundle\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="user_group")
 */
class UserGroup
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="group_id", type="integer", nullable=false)
     */
    private $groupId;

     /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="groups")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var boolean
     * @ORM\Column(name="group_leader", type="boolean", nullable=false)
     */
    private $groupLeader;

    /**
     * @var boolean
     * @ORM\Column(name="user_pending", type="boolean", nullable=false)
     */
    private $userPending;

    /**
     * @param integer $groupId
     * @return UserGroup
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param integer $user
     * @return UserGroup
     */
    public function setUser($user)
    {
        $this->userId = $user;
        return $this;
    }

    /**
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param boolean $groupLeader
     * @return UserGroup
     */
    public function setGroupLeader($groupLeader)
    {
        $this->groupLeader = $groupLeader;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getGroupLeader()
    {
        return $this->groupLeader;
    }

    /**
     * @param boolean $userPending
     * @return UserGroup
     */
    public function setUserPending($userPending)
    {
        $this->userPending = $userPending;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getUserPending()
    {
        return $this->userPending;
    }
}
