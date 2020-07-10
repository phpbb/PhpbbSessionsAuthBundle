<?php

/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * @author TeLiXj <telixj@gmail.com>
 */
class PhpbbSessionAuthenticator extends AbstractGuardAuthenticator
{
    public const ANONYMOUS_USER_ID = 1;
    private $cookieName;
    private $loginPage;
    private $forceLogin;

    /**
     * @param string $cookieName
     * @param string $loginPage string
     * @param string $forceLogin boolean
     */
    public function __construct($cookieName, $loginPage, $forceLogin)
    {
        $this->cookieName = $cookieName;
        $this->loginPage = $loginPage;
        $this->forceLogin = $forceLogin;
    }

    public function supports(Request $request)
    {
        return true;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCredentials(Request $request)
    {
        return [
            'ip' => $request->getClientIp(),
            'key'  => md5($request->cookies->get($this->cookieName.'_k')),
            'session' => $request->cookies->get($this->cookieName.'_sid'),
            'user' => $request->cookies->get($this->cookieName.'_u')
        ];
    }

    /**
     * @param array $credentials
     * @param UserProviderInterface $userProvider
     * @return User|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!$userProvider instanceof PhpbbUserProvider) {
            throw new \InvalidArgumentException(sprintf(
                'The user provider must be an instance of PhpbbUserProvider (%s was given).',
                get_class($userProvider)
            ));
        }

        if (!$credentials['session'] || !$credentials['user'] || $credentials['user'] == self::ANONYMOUS_USER_ID) { //if no session or anonymous user
            if ($this->forceLogin) {
                throw new CustomUserMessageAuthenticationException('can not authenticate user via phpbb');
            }
            return;
        }

        if ($user = $userProvider->getUserFromSession($credentials['ip'], $credentials['session'], $credentials['user'])) {
            return $user;
        }

        if ($credentials['key'] && $userProvider->checkKey($credentials['ip'], $credentials['key'], $credentials['user'])) {
            $this->forceLogin = true;
            throw new CustomUserMessageAuthenticationException('valid key without session');
        }
    }

    /**
     * @param array $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param mixed $providerKey
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return RedirectResponse|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return $this->forceLogin ? $this->start($request, $exception) : null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return RedirectResponse
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse($this->loginPage."&redirect=".$request->getRequestUri());
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        return true;
    }

    /**
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
