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
    #[ORM\Column(name: 'session_id')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'sessions')]
    #[ORM\JoinColumn(name: 'session_user_id', referencedColumnName: 'user_id')]
    private User $user;

    #[ORM\Column(name: 'session_forum_id')]
    private ?int $forumId = null;

    #[ORM\Column(name: 'session_last_visit')]
    private ?int $lastVisit = null;

    #[ORM\Column(name: 'session_start')]
    private ?int $start = null;

    #[ORM\Column(name: 'session_time')]
    private ?int $time = null;

    #[ORM\Column(name: 'session_ip')]
    private ?string $ip = null;

    #[ORM\Column(name: 'session_browser', length: 150)]
    private ?string $browser = null;

    #[ORM\Column(name: 'session_forwarded_for', length: 255)]
    private ?string $forwardedFor = null;

    #[ORM\Column(name: 'session_page', length: 255)]
    private ?string $page = null;

    #[ORM\Column(name: 'session_viewonline')]
    private ?bool $viewonline = null;

    #[ORM\Column(name: 'session_autologin')]
    private ?bool $autologin = null;

    #[ORM\Column(name: 'session_admin')]
    private ?bool $admin = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setForumId($forumId): self
    {
        $this->forumId = $forumId;

        return $this;
    }

    public function getForumId(): ?int
    {
        return $this->forumId;
    }

    public function setLastVisit(int $lastVisit): self
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    public function getLastVisit(): ?int
    {
        return $this->lastVisit;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(mixed $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function setBrowser(string $browser): self
    {
        $this->browser = $browser;

        return $this;
    }

    public function getBrowser(): ?string
    {
        return $this->browser;
    }

    public function setForwardedFor(string $forwardedFor): self
    {
        $this->forwardedFor = $forwardedFor;

        return $this;
    }

    public function getForwardedFor(): ?string
    {
        return $this->forwardedFor;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setViewonline(bool $viewonline): self
    {
        $this->viewonline = $viewonline;

        return $this;
    }

    public function getViewonline(): ?bool
    {
        return $this->viewonline;
    }

    public function getAutologin(): ?bool
    {
        return $this->autologin;
    }

    public function setAutologin(bool $autologin): self
    {
        $this->autologin = $autologin;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
