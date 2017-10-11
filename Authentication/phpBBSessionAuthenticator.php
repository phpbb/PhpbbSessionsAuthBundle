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

        $sessionId = $this->requestStack->getCurrentRequest()->cookies->get($this->cookieName . '_sid');
        $userId    = $this->requestStack->getCurrentRequest()->cookies->get($this->cookieName . '_u');

        if (empty($sessionId))
        {
            return $this->createAnonymousToken($providerKey); // We can't authenticate if no SID is available.
        }

        /** @var Session $session */
        $session = $this->entityManager
            ->getRepository('phpbbSessionsAuthBundle:Session')
            ->findOneById($sessionId, [ 'time' => 'DESC' ])
        ;

        if (!$session ||
            $session->getUser() == null ||
            ($session->getUser() != null && $session->getUser()->getId() == self::ANONYMOUS) ||
            $session->getUser()->getId() != $userId)
        {
            return $this->createAnonymousToken($providerKey);;
        }

        $userIp = $this->requestStack->getCurrentRequest()->getClientIp();

        if (strpos($userIp, ':') !== false && strpos($session->getIp(), ':') !== false)
        {
            $s_ip = $this->shortIpv6($session->getIp(), 3);
            $u_ip = $this->shortIpv6($userIp, 3);
        }
        else
        {
            $s_ip = implode('.', array_slice(explode('.', $session->getIp()), 0, 3));
            $u_ip = implode('.', array_slice(explode('.', $userIp), 0, 3));
        }

        // Assume session length of 3600
        $isIpOk = $u_ip === $s_ip;
        $isSessionTimeOk = $session->getTime() + 3660 >= time();
        $isAutologin = $session->getAutologin();
        if ($isIpOk && ($isAutologin || $isSessionTimeOk))
        {
            // We have a valid user, which is not the guest user.
            $roles = ['ROLE_PHPBB_USER'];
            $token = new phpBBToken($session->getUser(), $providerKey, $roles);

            return $token;
        }

        return $this->createAnonymousToken($providerKey);;
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

    /**
     * Returns the first block of the specified IPv6 address and as many additional
     * ones as specified in the length paramater.
     * If length is zero, then an empty string is returned.
     * If length is greater than 3 the complete IP will be returned
     *
     * @copyright (c) phpBB Limited <https://www.phpbb.com>
     * @license GNU General Public License, version 2 (GPL-2.0)
     *
     * @param $ip
     * @param $length
     * @return mixed|string
     */
    private function shortIpv6($ip, $length)
    {
        if ($length < 1)
        {
            return '';
        }

        // extend IPv6 addresses
        $blocks = substr_count($ip, ':') + 1;
        if ($blocks < 9)
        {
            $ip = str_replace('::', ':' . str_repeat('0000:', 9 - $blocks), $ip);
        }
        if ($ip[0] == ':')
        {
            $ip = '0000' . $ip;
        }
        if ($length < 4)
        {
            $ip = implode(':', array_slice(explode(':', $ip), 0, 1 + $length));
        }

        return $ip;
    }

    private function createAnonymousToken($providerKey)
    {
        if ($this->forceLogin) {
            throw new CustomUserMessageAuthenticationException('can not authenticate user via phpbb');
        }

        return new AnonymousToken($this->secret, 'anon.');
    }
}
