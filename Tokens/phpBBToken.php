<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Tokens;


use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\User\UserInterface;

class phpBBToken extends AbstractToken {
    private $providerKey;

    /**
     * Constructor.
     * @param string|UserInterface $user
     * @param $providerKey
     * @param array $roles
     */
    public function __construct($user, $providerKey, array $roles = array())
    {
        parent::__construct($roles);

        if (empty($providerKey))
        {
            throw new \InvalidArgumentException('$providerKey must not be empty.');
        }

        $this->setUser($user);
        $this->providerKey = $providerKey;

        if (!empty($roles))
        {
            $this->setAuthenticated(true);
        }
    }

    /**
     * Returns the provider key.
     *
     * @return string The provider key
     */
    public function getProviderKey()
    {
        return $this->providerKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        parent::eraseCredentials();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array($this->providerKey, parent::serialize()));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($str)
    {
        list($this->providerKey, $parentStr) = unserialize($str);
        parent::unserialize($parentStr);
    }
}

