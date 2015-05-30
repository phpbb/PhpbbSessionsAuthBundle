<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Authentication;


use phpBB\SessionsAuthBundle\Tokens\phpBBToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class phpBBSessionAuthenticator implements SimplePreAuthenticatorInterface{

    /** @var  String */
    private $cookiename;

    /** @var null|Request  */
    private $request;
    public function __construct($cookiename, RequestStack $requestStack) {
        $this->cookiename = $cookiename;
        $this->request = $requestStack->getCurrentRequest();

    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        // TODO: Implement authenticateToken() method.
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof phpBBToken && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $providerKey)
    {
        if ($request->cookies->get($this->cookiename . '_sid') == null) {
            return null;
        }
        return new phpBBToken('anon.', $providerKey);
    }
}