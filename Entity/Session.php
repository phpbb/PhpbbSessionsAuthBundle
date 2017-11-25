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
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Session
 * @package phpbb\SessionsAuthBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="sessions")
 */
class Session
{
    /**
     * @var string
     * @ORM\Column(name="session_id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sessions")
     * @ORM\JoinColumn(name="session_user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var integer
     * @ORM\Column(name="session_forum_id", type="integer", nullable=false)
     */
    private $forumId;

    /**
     * @var integer
     * @ORM\Column(name="session_last_visit", type="integer", nullable=false)
     */
    private $lastVisit;

    /**
     * @var integer
     * @ORM\Column(name="session_start", type="integer", nullable=false)
     */
    private $start;

    /**
     * @var
     * @ORM\Column(name="session_time", type="integer", nullable=false)
     */
    private $time;

    /**
     * @var string
     * @ORM\Column(name="session_ip", type="string", nullable=false)
     */
    private $ip;

    /**
     * @var string
     * @ORM\Column(name="session_browser", type="string", length=150, nullable=false)
     */
    private $browser;

    /**
     * @var string
     * @ORM\Column(name="session_forwarded_for", type="string", length=255, nullable=false)
     */
    private $forwardedFor;

    /**
     * @var string
     * @ORM\Column(name="session_page", type="string", length=255, nullable=false)
     */
    private $page;

    /**
     * @var boolean
     * @ORM\Column(name="session_viewonline", type="boolean", nullable=false)
     */
    private $viewonline;

    /**
     * @var boolean
     * @ORM\Column(name="session_autologin", type="boolean", nullable=false)
     */
    private $autologin;

    /**
     * @var boolean
     * @ORM\Column(name="session_admin", type="boolean", nullable=false)
     */
    private $admin;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param integer $ForumId
     * @return Sessions
     */
    public function setForumId($forumId)
    {
        $this->forumId = $forumId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getForumId()
    {
        return $this->forumId;
    }

    /**
     * @param integer $lastVisit
     * @return Sessions
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * @param integer $start
     * @return Sessions
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return integer
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @param string $browser
     * @return Sessions
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param string $forwardedFor
     * @return Sessions
     */
    public function setForwardedFor($forwardedFor)
    {
        $this->forwardedFor = $forwardedFor;
        return $this;
    }

    /**
     * @return string
     */
    public function getForwardedFor()
    {
        return $this->forwardedFor;
    }

    /**
     * @param string $page
     * @return Sessions
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param boolean $viewonline
     * @return Sessions
     */
    public function setViewonline($viewonline)
    {
        $this->viewonline = $viewonline;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getViewonline()
    {
        return $this->viewonline;
    }

    /**
     * @return boolean
     */
    public function getAutologin()
    {
        return $this->autologin;
    }

    /**
     * @param boolean $autologin
     * @return Session
     */
    public function setAutologin($autologin)
    {
        $this->autologin = $autologin;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param boolean $admin
     * @return Sessions
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }
}
