<?php

/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Security;

use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\{Badge\UserBadge, Passport, SelfValidatingPassport};

/**
 * @author TeLiXj <telixj@gmail.com>
 */
class PhpbbSessionAuthenticator extends AbstractAuthenticator
{
    public const ANONYMOUS_USER_ID = 1;

    public function __construct(private string $cookieName, private string $loginPage, private string $forceLogin, private PhpbbUserProvider $userProvider) {}

    public function supports(Request $request): ?bool
    {
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        $credentials = [
            'ip' => $request->getClientIp(),
            'key' => md5($request->cookies->get($this->cookieName.'_k')),
            'session' => $request->cookies->get($this->cookieName.'_sid'),
            'user' => $request->cookies->get($this->cookieName.'_u')
        ];
        return new SelfValidatingPassport(new UserBadge("", function() use ($credentials) {
            if (!$credentials['user'] || $credentials['user'] == self::ANONYMOUS_USER_ID) {
                return null;
            }
            if ($credentials['session'] && ($user = $this->userProvider->getUserFromSession($credentials['ip'], $credentials['session'], $credentials['user']))) {
                return $user;
            }
            if ($credentials['key'] && $this->userProvider->checkKey($credentials['ip'], $credentials['key'], $credentials['user'])) {
                $this->forceLogin = true;
            }
            return null;
        }));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?RedirectResponse
    {
        return $this->forceLogin ? new RedirectResponse($this->loginPage."&redirect=".$request->getRequestUri()) : null;
    }
}
