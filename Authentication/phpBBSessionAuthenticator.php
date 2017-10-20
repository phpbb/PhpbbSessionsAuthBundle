<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Authentication;


use Doctrine\ORM\EntityManager;
use phpBB\SessionsAuthBundle\Authentication\Provider\phpBBUserProvider;
use phpBB\SessionsAuthBundle\Entity\Session;
use phpBB\SessionsAuthBundle\Tokens\phpBBToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

class phpBBSessionAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    const ANONYMOUS = 1;

    /** @var  string */
    private $cookieName;

    /** @var  string */
    private $boardUrl;

    /** @var  string */
    private $loginPage;

    /** @var RequestStack  */
    private $requestStack;

    /**
     * entityManager
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * forceLogin
     *
     * @var bool
     */
    private $forceLogin;

    /**
     * secret
     *
     * @var string
     */
    private $secret;

    /**
     * @param $cookiename string
     * @param $boardurl  string
     * @param $loginpage string
     * @param $forceLogin boolean
     * @param $secret string
     * @param $requestStack RequestStack
     */
    public function __construct(
        $cookiename,
        $boardurl,
        $loginpage,
        $forceLogin,
        $secret,
        RequestStack $requestStack
    ) {
        $this->cookieName    = $cookiename;
        $this->boardUrl      = $boardurl;
        $this->loginPage     = $loginpage;
        $this->requestStack  = $requestStack;
        $this->forceLogin    = $forceLogin;
        $this->secret        = $secret;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @return null|phpBBToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof phpBBUserProvider)
        {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of phpBBUserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        $request = $this->requestStack->getCurrentRequest();

        $sessionId = $request->cookies->get($this->cookieName . '_sid');
        $expectedUserId = $request->cookies->get($this->cookieName . '_u');

        $username = $userProvider->getUsernameForSessionId($sessionId, $expectedUserId, $request->getClientIp());

        if (!$username)
        {
            return $this->createAnonymousToken($providerKey); // We can't authenticate if no SID is available.
        }

        $user = $userProvider->loadUserByUsername($username);

        // We have a valid user, which is not the guest user.
        $roles = ['ROLE_PHPBB_USER'];
        $token = new phpBBToken($user, $providerKey, $roles);

        return $token;
    }

    /**
     * @param TokenInterface $token
     * @param $providerKey
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof phpBBToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * @param Request $request
     * @param $providerKey
     * @return phpBBToken
     */
    public function createToken(Request $request, $providerKey)
    {
        return new phpBBToken('anon.', $providerKey);
    }

    /**
     * On a authentication failure we redirect to the phpBB Login page.
     *
     * @param Request $request
     * @param AuthenticationException $exception
     * @return RedirectResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($this->forceLogin) {
            return new RedirectResponse($this->boardUrl . $this->loginPage);
        }
    }

    private function createAnonymousToken($providerKey)
    {
        if ($this->forceLogin) {
            throw new CustomUserMessageAuthenticationException('can not authenticate user via phpbb');
        }

        return new AnonymousToken($this->secret, 'anon.');
    }
}
