<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package phpbb\SessionsAuthBundle\Entity
 * @ORM\Entity(readOnly=true)
 */
class User {
    /**
     * @var
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $user_id;
}