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
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

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

    /** @var ContainerInterface  */
    private $container;

    /** @var  string */
    private $dbConnection;

    /**
     * @param $cookiename string
     * @param $boardurl  string
     * @param $loginpage string
     * @param $requestStack RequestStack
     * @param ContainerInterface $container
     */
    public function __construct($cookiename, $boardurl, $loginpage, $dbconnection,
                                RequestStack $requestStack, ContainerInterface $container)
    {
        $this->cookieName   = $cookiename;
        $this->boardUrl     = $boardurl;
        $this->loginPage    = $loginpage;
        $this->dbConnection = $dbconnection;
        $this->requestStack = $requestStack;
        $this->container    = $container;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @return null|
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
            return null; // We can't authenticate if no SID is available.
        }

        /** @var EntityManager $em */
        $em = $this->container->get('doctrine')->getManager($this->dbConnection);

        /** @var Session $session */
        $session = $em->getRepository('phpbbSessionsAuthBundle:Session')->findById($sessionId);


        if (!$session || $session->getUser() != null && $session->getUser()->getId() == self::ANONYMOUS)
        {
            return null;
        }

        if ($session->getUser()->getId() != $userId)
        {
            throw new \InvalidArgumentException("Incorrect session cookie found with username");
        }
        // @TODO: IP validation.

        // We have a valid user, which is not the guest user.

        $roles = array();
        // @TODO: Assign roles.

        $token = new phpBBToken($token->getUser(), $providerKey, $roles);

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
        return new RedirectResponse($this->boardUrl . $this->loginPage);
    }
}

