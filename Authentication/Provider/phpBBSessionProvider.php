<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Entity;

use phpBB\SessionsAuthBundle\Tokens\phpBBToken;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class phpBBSessionProvider
{
    /** @var  UserProviderInterface */
    private $userProvider;

    /** @var  UserCheckerInterface */
    private $userChecker;

    /** @var  string */
    private $providerKey;

    /**
     * Constructor.
     *
     * @param UserProviderInterface $userProvider An UserProviderInterface instance
     * @param UserCheckerInterface $userChecker An UserCheckerInterface instance
     * @param string $providerKey The provider key
     */
    public function __construct(UserProviderInterface $userProvider, UserCheckerInterface $userChecker, $providerKey)
    {
        $this->userProvider = $userProvider;
        $this->userChecker  = $userChecker;
        $this->providerKey  = $providerKey;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
        if (!$this->supports($token))
        {
            return;
        }

        if (!$user = $token->getUser())
        {
            throw new BadCredentialsException('The required token is not found.');
        }

        $user = $this->userProvider->loadUserByUsername($user);
        $this->userChecker->checkPostAuth($user);
        $authenticatedToken = new phpBBToken($user, $this->providerKey, $user->getRoles());
        $authenticatedToken->setAttributes($token->getAttributes());

        return $authenticatedToken;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof phpBBToken && $this->providerKey === $token->getProviderKey();
    }
}

