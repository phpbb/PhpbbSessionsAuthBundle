<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */

namespace phpBB\SessionsAuthBundle\Tokens;


use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;

class phpBBToken extends PreAuthenticatedToken{
    public function __construct($user, $credentials, $providerKey, array $roles = array())
    {
        parent::__construct($user, $credentials, $providerKey, $roles);
    }
}
