<?php
/**
 *
 * @package phpBBSessionsAuthBundle
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 *
 */
namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package phpbb\SessionsAuthBundle\Entity
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @var integer
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var boolean
     * @ORM\Column(name="user_type", type="boolean")
     */
    private $type;

    /**
     * @var integer
     * @ORM\Column(name="group_id", type="integer")
     */
    private $groupId;

    /**
     * @var string
     * @ORM\Column(name="user_permissions", type="text")
     */
    private $permissions;

    /**
     * @var integer
     * @ORM\Column(name="user_perm_from", type="integer")
     */
    private $permFrom;

    /**
     * @var string
     * @ORM\Column(name="user_ip", type="string", length=40)
     */
    private $ip;

    /**
     * @var integer
     * @ORM\Column(name="user_regdate", type="integer")
     */
    private $regdate;

    /**
     * @var string
     * @ORM\Column(name="username", type="string")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="username_clean", type="string")
     */
    private $nameClean;

    /**
    * @var string
    * @ORM\Column(name="user_password", type="string")
    */
    private $password;

    /**
     * @var integer
     * @ORM\Column(name="user_passchg", type="integer")
     */
    private $passchg;

    /**
     * @var string
     * @ORM\Column(name="user_email", type="string")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="user_birthday", type="string")
     */
    private $birthday;

    /**
     * @var integer
     * @ORM\Column(name="user_lastvisit", type="integer")
     */
    private $lastvisit;

    /**
     * @var integer
     * @ORM\Column(name="user_lastmark", type="integer")
     */
    private $lastmark;

    /**
     * @var integer
     * @ORM\Column(name="user_lastpost_time", type="integer")
     */
    private $lastpostTime;

    /**
     * @var string
     * @ORM\Column(name="user_lastpage", type="string")
     */
    private $lastpage;

    /**
     * @var string
     * @ORM\Column(name="user_last_confirm_key", type="string")
     */
    private $lastConfirmKey;

    /**
     * @var integer
     * @ORM\Column(name="user_last_search", type="integer")
     */
    private $lastSearch;

    /**
     * @var boolean
     * @ORM\Column(name="user_warnings", type="boolean")
     */
    private $warnings;

    /**
     * @var integer
     * @ORM\Column(name="user_last_warning", type="integer")
     */
    private $lastWarning;

    /**
     * @var boolean
     * @ORM\Column(name="user_login_attempts", type="boolean")
     */
    private $loginAttempts;

    /**
     * @var boolean
     * @ORM\Column(name="user_inactive_reason", type="boolean")
     */
    private $inactiveReason;

    /**
     * @var integer
     * @ORM\Column(name="user_inactive_time", type="integer")
     */
    private $inactiveTime;

    /**
     * @var integer
     * @ORM\Column(name="user_posts", type="integer")
     */
    private $posts;

    /**
     * @var string
     * @ORM\Column(name="user_lang", type="string")
     */
    private $lang;

    /**
     * @var float
     * @ORM\Column(name="user_timezone", type="decimal")
     */
    private $timezone;

    /**
     * @var string
     * @ORM\Column(name="user_dateformat", type="string")
     */
    private $dateformat;

    /**
     * @var integer
     * @ORM\Column(name="user_style", type="integer")
     */
    private $style;

    /**
     * @var integer
     * @ORM\Column(name="user_rank", type="integer")
     */
    private $rank;

    /**
     * @var string
     * @ORM\Column(name="user_colour", type="string")
     */
    private $colour;

    /**
     * @var integer
     * @ORM\Column(name="user_new_privmsg", type="integer")
     */
    private $newPrivmsg;

    /**
     * @var integer
     * @ORM\Column(name="user_unread_privmsg", type="integer")
     */
    private $unreadPrivmsg;

    /**
     * @var integer
     * @ORM\Column(name="user_last_privmsg", type="integer")
     */
    private $lastPrivmsg;

    /**
     * @var boolean
     * @ORM\Column(name="user_message_rules", type="boolean")
     */
    private $messageRules;

    /**
     * @var integer
     * @ORM\Column(name="user_full_folder", type="integer")
     */
    private $fullFolder;

    /**
     * @var integer
     * @ORM\Column(name="user_emailtime", type="integer")
     */
    private $emailtime;

    /**
     * @var integer
     * @ORM\Column(name="user_topic_show_days", type="smallint")
     */
    private $topicShowDays;

    /**
     * @var string
     * @ORM\Column(name="user_topic_sortby_type", type="string")
     */
    private $topicSortbyType;

    /**
     * @var string
     * @ORM\Column(name="user_topic_sortby_dir", type="string")
     */
    private $topicSortbyDir;

    /**
     * @var integer
     * @ORM\Column(name="user_post_show_days", type="smallint")
     */
    private $postShowDays;

    /**
     * @var string
     * @ORM\Column(name="user_post_sortby_type", type="string")
     */
    private $postSortbyType;

    /**
     * @var string
     * @ORM\Column(name="user_post_sortby_dir", type="string")
     */
    private $postSortbyDir;

    /**
     * @var boolean
     * @ORM\Column(name="user_notify", type="boolean")
     */
    private $notify;

    /**
     * @var boolean
     * @ORM\Column(name="user_notify_pm", type="boolean")
     */
    private $notifyPm;

    /**
     * @var boolean
     * @ORM\Column(name="user_notify_type", type="boolean")
     */
    private $notifyType;

    /**
     * @var boolean
     * @ORM\Column(name="user_allow_pm", type="boolean")
     */
    private $allowPm;

    /**
     * @var boolean
     * @ORM\Column(name="user_allow_viewonline", type="boolean")
     */
    private $allowViewonline;

    /**
     * @var boolean
     * @ORM\Column(name="user_allow_viewemail", type="boolean")
     */
    private $allowViewemail;

    /**
     * @var boolean
     * @ORM\Column(name="user_allow_massemail", type="boolean")
     */
    private $allowMassemail;

    /**
     * @var integer
     * @ORM\Column(name="user_options", type="integer")
     */
    private $options;

    /**
     * @var string
     * @ORM\Column(name="user_avatar", type="string")
     */
    private $avatar;

    /**
     * @var boolean
     * @ORM\Column(name="user_avatar_type", type="boolean")
     */
    private $avatarType;

    /**
     * @var integer
     * @ORM\Column(name="user_avatar_width", type="smallint")
     */
    private $avatarWidth;

    /**
     * @var integer
     * @ORM\Column(name="user_avatar_height", type="smallint")
     */
    private $avatarHeight;

    /**
     * @var string
     * @ORM\Column(name="user_sig", type="text")
     */
    private $sig;

    /**
     * @var string
     * @ORM\Column(name="user_sig_bbcode_uid", type="string")
     */
    private $sigBbcodeUid;

    /**
     * @var string
     * @ORM\Column(name="user_sig_bbcode_bitfield", type="string")
     */
    private $sigBbcodeBitfield;

    /**
     * @var string
     * @ORM\Column(name="user_jabber", type="string")
     */
    private $jabber;

    /**
     * @var string
     * @ORM\Column(name="user_actkey", type="string")
     */
    private $actkey;

    /**
     * @var string
     * @ORM\Column(name="user_newpasswd", type="string")
     */
    private $newpasswd;

    /**
     * @var string
     * @ORM\Column(name="user_form_salt", type="string")
     */
    private $formSalt;

    /**
     * @var boolean
     * @ORM\Column(name="user_new", type="boolean")
     */
    private $new;

    /**
     * @var boolean
     * @ORM\Column(name="user_reminded", type="boolean")
     */
    private $reminded;

    /**
     * @var integer
     * @ORM\Column(name="user_reminded_time", type="integer")
     */
    private $remindedTime;

    /**
     * @var array
     */
    private $roles = [];

    /**
    * @var ArrayCollection
    * @ORM\OneToMany(targetEntity="UserGroup", mappedBy="user")
    */
    private $groups;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Session", mappedBy="user")
     */
    private $sessions;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param boolean $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $groupId
     * @return User
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param string $permissions
     * @return User
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return string
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param integer $permFrom
     * @return User
     */
    public function setPermFrom($permFrom)
    {
        $this->permFrom = $permFrom;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPermFrom()
    {
        return $this->permFrom;
    }

    /**
     * @param string $ip
     * @return User
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param integer $regdate
     * @return User
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;
        return $this;
    }

    /**
     * @return integer
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $usernameClean
     * @return User
     */
    public function setUsernameClean($usernameClean)
    {
        $this->nameClean = $usernameClean;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsernameClean()
    {
        return $this->nameClean;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     *
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * The password will not be returned by this class. Symfony doesn't need
     * the password of a phpBB user, as the User entity is read only.
     *
     * Any changes to the user should be made within phpBB.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param integer $passchg
     * @return User
     */
    public function setPasschg($passchg)
    {
        $this->passchg = $passchg;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPasschg()
    {
        return $this->passchg;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param integer $lastvisit
     * @return User
     */
    public function setLastvisit($lastvisit)
    {
        $this->lastvisit = $lastvisit;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastvisit()
    {
        return $this->lastvisit;
    }

    /**
     * @param integer $lastmark
     * @return User
     */
    public function setLastmark($lastmark)
    {
        $this->lastmark = $lastmark;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastmark()
    {
        return $this->lastmark;
    }

    /**
     * @param integer $lastpostTime
     * @return User
     */
    public function setLastpostTime($lastpostTime)
    {
        $this->lastpostTime = $lastpostTime;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastpostTime()
    {
        return $this->lastpostTime;
    }

    /**
     * @param string $lastpage
     * @return User
     */
    public function setLastpage($lastpage)
    {
        $this->lastpage = $lastpage;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastpage()
    {
        return $this->lastpage;
    }

    /**
     * @param string $lastConfirmKey
     * @return User
     */
    public function setLastConfirmKey($lastConfirmKey)
    {
        $this->lastConfirmKey = $lastConfirmKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastConfirmKey()
    {
        return $this->lastConfirmKey;
    }

    /**
     * @param integer $lastSearch
     * @return User
     */
    public function setLastSearch($lastSearch)
    {
        $this->lastSearch = $lastSearch;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastSearch()
    {
        return $this->lastSearch;
    }

    /**
     * @param boolean $warnings
     * @return User
     */
    public function setWarnings($warnings)
    {
        $this->warnings = $warnings;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param integer $lastWarning
     * @return User
     */
    public function setLastWarning($lastWarning)
    {
        $this->lastWarning = $lastWarning;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastWarning()
    {
        return $this->lastWarning;
    }

    /**
     * @param boolean $loginAttempts
     * @return User
     */
    public function setLoginAttempts($loginAttempts)
    {
        $this->loginAttempts = $loginAttempts;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getLoginAttempts()
    {
        return $this->loginAttempts;
    }

    /**
     * @param boolean $inactiveReason
     * @return User
     */
    public function setInactiveReason($inactiveReason)
    {
        $this->inactiveReason = $inactiveReason;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getInactiveReason()
    {
        return $this->inactiveReason;
    }

    /**
     * @param integer $inactiveTime
     * @return User
     */
    public function setInactiveTime($inactiveTime)
    {
        $this->inactiveTime = $inactiveTime;
        return $this;
    }

    /**
     * @return integer
     */
    public function getInactiveTime()
    {
        return $this->inactiveTime;
    }

    /**
     * @param integer $posts
     * @return User
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param string $lang
     * @return User
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param float $timezone
     * @return User
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return float
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $dateformat
     * @return User
     */
    public function setDateformat($dateformat)
    {
        $this->dateformat = $dateformat;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateformat()
    {
        return $this->dateformat;
    }

    /**
     * @param integer $style
     * @return User
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return integer
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param integer $rank
     * @return User
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param string $colour
     * @return User
     */
    public function setColour($colour)
    {
        $this->colour = $colour;
        return $this;
    }

    /**
     * @return string
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * @param integer $newPrivmsg
     * @return User
     */
    public function setNewPrivmsg($newPrivmsg)
    {
        $this->newPrivmsg = $newPrivmsg;
        return $this;
    }

    /**
     * @return integer
     */
    public function getNewPrivmsg()
    {
        return $this->newPrivmsg;
    }

    /**
     * @param integer $unreadPrivmsg
     * @return User
     */
    public function setUnreadPrivmsg($unreadPrivmsg)
    {
        $this->unreadPrivmsg = $unreadPrivmsg;
        return $this;
    }

    /**
     * @return integer
     */
    public function getUnreadPrivmsg()
    {
        return $this->unreadPrivmsg;
    }

    /**
     * @param integer $lastPrivmsg
     * @return User
     */
    public function setLastPrivmsg($lastPrivmsg)
    {
        $this->lastPrivmsg = $lastPrivmsg;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLastPrivmsg()
    {
        return $this->lastPrivmsg;
    }

    /**
     * @param boolean $messageRules
     * @return User
     */
    public function setMessageRules($messageRules)
    {
        $this->messageRules = $messageRules;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getMessageRules()
    {
        return $this->messageRules;
    }

    /**
     * @param integer $fullFolder
     * @return User
     */
    public function setFullFolder($fullFolder)
    {
        $this->fullFolder = $fullFolder;
        return $this;
    }

    /**
     * @return integer
     */
    public function getFullFolder()
    {
        return $this->fullFolder;
    }

    /**
     * @param integer $emailtime
     * @return User
     */
    public function setEmailtime($emailtime)
    {
        $this->emailtime = $emailtime;
        return $this;
    }

    /**
     * @return integer
     */
    public function getEmailtime()
    {
        return $this->emailtime;
    }

    /**
     * @param integer $topicShowDays
     * @return User
     */
    public function setTopicShowDays($topicShowDays)
    {
        $this->topicShowDays = $topicShowDays;
        return $this;
    }

    /**
     * @return integer
     */
    public function getTopicShowDays()
    {
        return $this->topicShowDays;
    }

    /**
     * @param string $topicSortbyType
     * @return User
     */
    public function setTopicSortbyType($topicSortbyType)
    {
        $this->topicSortbyType = $topicSortbyType;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopicSortbyType()
    {
        return $this->topicSortbyType;
    }

    /**
     * @param string $topicSortbyDir
     * @return User
     */
    public function setTopicSortbyDir($topicSortbyDir)
    {
        $this->topicSortbyDir = $topicSortbyDir;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopicSortbyDir()
    {
        return $this->topicSortbyDir;
    }

    /**
     * @param integer $postShowDays
     * @return User
     */
    public function setPostShowDays($postShowDays)
    {
        $this->postShowDays = $postShowDays;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPostShowDays()
    {
        return $this->postShowDays;
    }

    /**
     * @param string $postSortbyType
     * @return User
     */
    public function setPostSortbyType($postSortbyType)
    {
        $this->postSortbyType = $postSortbyType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostSortbyType()
    {
        return $this->postSortbyType;
    }

    /**
     * @param string $postSortbyDir
     * @return User
     */
    public function setPostSortbyDir($postSortbyDir)
    {
        $this->postSortbyDir = $postSortbyDir;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostSortbyDir()
    {
        return $this->postSortbyDir;
    }

    /**
     * @param boolean $notify
     * @return User
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * @param boolean $notifyPm
     * @return User
     */
    public function setNotifyPm($notifyPm)
    {
        $this->notifyPm = $notifyPm;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNotifyPm()
    {
        return $this->notifyPm;
    }

    /**
     * @param boolean $notifyType
     * @return User
     */
    public function setNotifyType($notifyType)
    {
        $this->notifyType = $notifyType;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNotifyType()
    {
        return $this->notifyType;
    }

    /**
     * @param boolean $allowPm
     * @return User
     */
    public function setAllowPm($allowPm)
    {
        $this->allowPm = $allowPm;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowPm()
    {
        return $this->allowPm;
    }

    /**
     * @param boolean $allowViewonline
     * @return User
     */
    public function setAllowViewonline($allowViewonline)
    {
        $this->allowViewonline = $allowViewonline;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowViewonline()
    {
        return $this->allowViewonline;
    }

    /**
     * @param boolean $allowViewemail
     * @return User
     */
    public function setAllowViewemail($allowViewemail)
    {
        $this->allowViewemail = $allowViewemail;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowViewemail()
    {
        return $this->allowViewemail;
    }

    /**
     * @param boolean $allowMassemail
     * @return User
     */
    public function setAllowMassemail($allowMassemail)
    {
        $this->allowMassemail = $allowMassemail;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowMassemail()
    {
        return $this->allowMassemail;
    }

    /**
     * @param integer $options
     * @return User
     */
    public function setOptions($options)
    {
        $this->Options = $options;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOptions()
    {
        return $this->Options;
    }

    /**
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param boolean $avatarType
     * @return User
     */
    public function setAvatarType($avatarType)
    {
        $this->avatarType = $avatarType;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAvatarType()
    {
        return $this->avatarType;
    }

    /**
     * @param integer $avatarWidth
     * @return User
     */
    public function setAvatarWidth($avatarWidth)
    {
        $this->avatarWidth = $avatarWidth;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAvatarWidth()
    {
        return $this->avatarWidth;
    }

    /**
     * @param integer $avatarHeight
     * @return User
     */
    public function setAvatarHeight($avatarHeight)
    {
        $this->avatarHeight = $avatarHeight;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAvatarHeight()
    {
        return $this->avatarHeight;
    }

    /**
     * @param string $sig
     * @return User
     */
    public function setSig($sig)
    {
        $this->sig = $sig;
        return $this;
    }

    /**
     * @return string
     */
    public function getSig()
    {
        return $this->sig;
    }

    /**
     * @param string $sigBbcodeUid
     * @return User
     */
    public function setSigBbcodeUid($sigBbcodeUid)
    {
        $this->sigBbcodeUid = $sigBbcodeUid;
        return $this;
    }

    /**
     * @return string
     */
    public function getSigBbcodeUid()
    {
        return $this->sigBbcodeUid;
    }

    /**
     * @param string $sigBbcodeBitfield
     * @return User
     */
    public function setSigBbcodeBitfield($sigBbcodeBitfield)
    {
        $this->sigBbcodeBitfield = $sigBbcodeBitfield;
        return $this;
    }

    /**
     * @return string
     */
    public function getSigBbcodeBitfield()
    {
        return $this->sigBbcodeBitfield;
    }

    /**
     * @param string $jabber
     * @return User
     */
    public function setJabber($jabber)
    {
        $this->jabber = $jabber;
        return $this;
    }

    /**
     * @return string
     */
    public function getJabber()
    {
        return $this->jabber;
    }

    /**
     * @param string $actkey
     * @return User
     */
    public function setActkey($actkey)
    {
        $this->actkey = $actkey;
        return $this;
    }

    /**
     * @return string
     */
    public function getActkey()
    {
        return $this->actkey;
    }

    /**
     * @param string $newpasswd
     * @return User
     */
    public function setNewpasswd($newpasswd)
    {
        $this->newpasswd = $newpasswd;
        return $this;
    }

    /**
     * @return string
     */
    public function getNewpasswd()
    {
        return $this->newpasswd;
    }

    /**
     * @param string $formSalt
     * @return User
     */
    public function setFormSalt($formSalt)
    {
        $this->formSalt = $formSalt;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormSalt()
    {
        return $this->formSalt;
    }

    /**
     * @param boolean $new
     * @return User
     */
    public function setNew($new)
    {
        $this->new = $new;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @param boolean $reminded
     * @return User
     */
    public function setReminded($reminded)
    {
        $this->reminded = $reminded;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getReminded()
    {
        return $this->reminded;
    }

    /**
     * @param integer $remindedTime
     * @return User
     */
    public function setRemindedTime($remindedTime)
    {
        $this->remindedTime = $remindedTime;
        return $this;
    }

    /**
     * @return integer
     */
    public function getRemindedTime()
    {
        return $this->remindedTime;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param ArrayCollection $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param ArrayCollection $sessions
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {}
}
