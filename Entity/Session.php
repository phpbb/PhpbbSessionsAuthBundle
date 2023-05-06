<?php
/**
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 */

namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'sessions')]
#[ORM\Entity]
class Session
{
    /**
     * @var string
     */
    #[ORM\Column(name: 'session_id')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?string $id = null;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'sessions')]
    #[ORM\JoinColumn(name: 'session_user_id', referencedColumnName: 'user_id')]
    private $user;

    /**
     * @var int
     */
    #[ORM\Column(name: 'session_forum_id')]
    private ?int $forumId = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'session_last_visit')]
    private ?int $lastVisit = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'session_start')]
    private ?int $start = null;

    #[ORM\Column(name: 'session_time')]
    private ?int $time = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'session_ip')]
    private ?string $ip = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'session_browser', length: 150)]
    private ?string $browser = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'session_forwarded_for', length: 255)]
    private ?string $forwardedFor = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'session_page', length: 255)]
    private ?string $page = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'session_viewonline')]
    private ?bool $viewonline = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'session_autologin')]
    private ?bool $autologin = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'session_admin')]
    private ?bool $admin = null;

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
     * @param int $ForumId
     *
     * @return Sessions
     */
    public function setForumId($forumId)
    {
        $this->forumId = $forumId;

        return $this;
    }

    /**
     * @return int
     */
    public function getForumId()
    {
        return $this->forumId;
    }

    /**
     * @param int $lastVisit
     *
     * @return Sessions
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * @param int $start
     *
     * @return Sessions
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return int
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

    public function setTime(mixed $time)
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
     *
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
     *
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
     *
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
     * @param bool $viewonline
     *
     * @return Sessions
     */
    public function setViewonline($viewonline)
    {
        $this->viewonline = $viewonline;

        return $this;
    }

    /**
     * @return bool
     */
    public function getViewonline()
    {
        return $this->viewonline;
    }

    /**
     * @return bool
     */
    public function getAutologin()
    {
        return $this->autologin;
    }

    /**
     * @param bool $autologin
     *
     * @return Session
     */
    public function setAutologin($autologin)
    {
        $this->autologin = $autologin;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     *
     * @return Sessions
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
}
