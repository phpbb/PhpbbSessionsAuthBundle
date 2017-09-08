<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package phpbb\SessionsAuthBundle\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @var
     * @ORM\Column(type="integer", name="user_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="username")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_email")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_password")
     */
    private $password;

    /**
     * @var Role[]
     */
    private $roles;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Session", mappedBy="user")
     */
    private $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * The password will not be returned by this class. Symfony doesn't need
     * the password of a phpBB user, as the User entity is read only.
     *
     * Any changes to the user should be made within phpBB.
     *
     * @return null
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param ArrayCollection $sessions
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;
    }
}

