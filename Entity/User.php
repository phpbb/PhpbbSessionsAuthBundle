<?php
/**
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 */

namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'users')]
#[ORM\Entity(readOnly: true)]
class User implements UserInterface
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'user_id')]
    #[ORM\Id]
    private ?int $id = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_type')]
    private ?bool $type = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'group_id')]
    private ?int $groupId = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_permissions', type: Types::TEXT)]
    private ?string $permissions = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_perm_from')]
    private ?int $permFrom = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_ip', length: 40)]
    private ?string $ip = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_regdate')]
    private ?int $regdate = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'username')]
    private ?string $username = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'username_clean')]
    private ?string $nameClean = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_password')]
    private ?string $password = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_passchg')]
    private ?int $passchg = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_email')]
    private ?string $email = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_birthday')]
    private ?string $birthday = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_lastvisit')]
    private ?int $lastvisit = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_lastmark')]
    private ?int $lastmark = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_lastpost_time')]
    private ?int $lastpostTime = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_lastpage')]
    private ?string $lastpage = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_last_confirm_key')]
    private ?string $lastConfirmKey = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_last_search')]
    private ?int $lastSearch = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_warnings')]
    private ?bool $warnings = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_last_warning')]
    private ?int $lastWarning = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_login_attempts')]
    private ?bool $loginAttempts = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_inactive_reason')]
    private ?bool $inactiveReason = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_inactive_time')]
    private ?int $inactiveTime = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_posts')]
    private ?int $posts = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_lang')]
    private ?string $lang = null;

    /**
     * @var float
     */
    #[ORM\Column(name: 'user_timezone', type: Types::DECIMAL)]
    private ?float $timezone = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_dateformat')]
    private ?string $dateformat = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_style')]
    private ?int $style = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_rank')]
    private ?int $rank = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_colour')]
    private ?string $colour = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_new_privmsg')]
    private ?int $newPrivmsg = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_unread_privmsg')]
    private ?int $unreadPrivmsg = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_last_privmsg')]
    private ?int $lastPrivmsg = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_message_rules')]
    private ?bool $messageRules = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_full_folder')]
    private ?int $fullFolder = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_emailtime')]
    private ?int $emailtime = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_topic_show_days', type: Types::SMALLINT)]
    private ?int $topicShowDays = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_topic_sortby_type')]
    private ?string $topicSortbyType = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_topic_sortby_dir')]
    private ?string $topicSortbyDir = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_post_show_days', type: Types::SMALLINT)]
    private ?int $postShowDays = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_post_sortby_type')]
    private ?string $postSortbyType = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_post_sortby_dir')]
    private ?string $postSortbyDir = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_notify')]
    private ?bool $notify = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_notify_pm')]
    private ?bool $notifyPm = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_notify_type')]
    private ?bool $notifyType = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_allow_pm')]
    private ?bool $allowPm = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_allow_viewonline')]
    private ?bool $allowViewonline = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_allow_viewemail')]
    private ?bool $allowViewemail = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_allow_massemail')]
    private ?bool $allowMassemail = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_options')]
    private ?int $options = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_avatar')]
    private ?string $avatar = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_avatar_type')]
    private ?bool $avatarType = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_avatar_width', type: Types::SMALLINT)]
    private ?int $avatarWidth = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_avatar_height', type: Types::SMALLINT)]
    private ?int $avatarHeight = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_sig', type: Types::TEXT)]
    private ?string $sig = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_sig_bbcode_uid')]
    private ?string $sigBbcodeUid = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_sig_bbcode_bitfield')]
    private ?string $sigBbcodeBitfield = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_jabber')]
    private ?string $jabber = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_actkey')]
    private ?string $actkey = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_newpasswd')]
    private ?string $newpasswd = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'user_form_salt')]
    private ?string $formSalt = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_new')]
    private ?bool $new = null;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'user_reminded')]
    private ?bool $reminded = null;

    /**
     * @var int
     */
    #[ORM\Column(name: 'user_reminded_time')]
    private ?int $remindedTime = null;

    private array $roles = [];

    #[ORM\OneToMany(targetEntity: 'UserGroup', mappedBy: 'user')]
    private ArrayCollection $groups;

    #[ORM\OneToMany(targetEntity: 'Session', mappedBy: 'user')]
    private ArrayCollection $sessions;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param bool $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $groupId
     *
     * @return User
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param string $permissions
     *
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
     * @param int $permFrom
     *
     * @return User
     */
    public function setPermFrom($permFrom)
    {
        $this->permFrom = $permFrom;

        return $this;
    }

    /**
     * @return int
     */
    public function getPermFrom()
    {
        return $this->permFrom;
    }

    /**
     * @param string $ip
     *
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
     * @param int $regdate
     *
     * @return User
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;

        return $this;
    }

    /**
     * @return int
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @param string $username
     *
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
     *
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
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
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
     * @param int $passchg
     *
     * @return User
     */
    public function setPasschg($passchg)
    {
        $this->passchg = $passchg;

        return $this;
    }

    /**
     * @return int
     */
    public function getPasschg()
    {
        return $this->passchg;
    }

    /**
     * @param string $email
     *
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
     *
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
     * @param int $lastvisit
     *
     * @return User
     */
    public function setLastvisit($lastvisit)
    {
        $this->lastvisit = $lastvisit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastvisit()
    {
        return $this->lastvisit;
    }

    /**
     * @param int $lastmark
     *
     * @return User
     */
    public function setLastmark($lastmark)
    {
        $this->lastmark = $lastmark;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastmark()
    {
        return $this->lastmark;
    }

    /**
     * @param int $lastpostTime
     *
     * @return User
     */
    public function setLastpostTime($lastpostTime)
    {
        $this->lastpostTime = $lastpostTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastpostTime()
    {
        return $this->lastpostTime;
    }

    /**
     * @param string $lastpage
     *
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
     *
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
     * @param int $lastSearch
     *
     * @return User
     */
    public function setLastSearch($lastSearch)
    {
        $this->lastSearch = $lastSearch;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastSearch()
    {
        return $this->lastSearch;
    }

    /**
     * @param bool $warnings
     *
     * @return User
     */
    public function setWarnings($warnings)
    {
        $this->warnings = $warnings;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param int $lastWarning
     *
     * @return User
     */
    public function setLastWarning($lastWarning)
    {
        $this->lastWarning = $lastWarning;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastWarning()
    {
        return $this->lastWarning;
    }

    /**
     * @param bool $loginAttempts
     *
     * @return User
     */
    public function setLoginAttempts($loginAttempts)
    {
        $this->loginAttempts = $loginAttempts;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLoginAttempts()
    {
        return $this->loginAttempts;
    }

    /**
     * @param bool $inactiveReason
     *
     * @return User
     */
    public function setInactiveReason($inactiveReason)
    {
        $this->inactiveReason = $inactiveReason;

        return $this;
    }

    /**
     * @return bool
     */
    public function getInactiveReason()
    {
        return $this->inactiveReason;
    }

    /**
     * @param int $inactiveTime
     *
     * @return User
     */
    public function setInactiveTime($inactiveTime)
    {
        $this->inactiveTime = $inactiveTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getInactiveTime()
    {
        return $this->inactiveTime;
    }

    /**
     * @param int $posts
     *
     * @return User
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param string $lang
     *
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
     *
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
     *
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
     * @param int $style
     *
     * @return User
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return int
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param int $rank
     *
     * @return User
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param string $colour
     *
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
     * @param int $newPrivmsg
     *
     * @return User
     */
    public function setNewPrivmsg($newPrivmsg)
    {
        $this->newPrivmsg = $newPrivmsg;

        return $this;
    }

    /**
     * @return int
     */
    public function getNewPrivmsg()
    {
        return $this->newPrivmsg;
    }

    /**
     * @param int $unreadPrivmsg
     *
     * @return User
     */
    public function setUnreadPrivmsg($unreadPrivmsg)
    {
        $this->unreadPrivmsg = $unreadPrivmsg;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnreadPrivmsg()
    {
        return $this->unreadPrivmsg;
    }

    /**
     * @param int $lastPrivmsg
     *
     * @return User
     */
    public function setLastPrivmsg($lastPrivmsg)
    {
        $this->lastPrivmsg = $lastPrivmsg;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastPrivmsg()
    {
        return $this->lastPrivmsg;
    }

    /**
     * @param bool $messageRules
     *
     * @return User
     */
    public function setMessageRules($messageRules)
    {
        $this->messageRules = $messageRules;

        return $this;
    }

    /**
     * @return bool
     */
    public function getMessageRules()
    {
        return $this->messageRules;
    }

    /**
     * @param int $fullFolder
     *
     * @return User
     */
    public function setFullFolder($fullFolder)
    {
        $this->fullFolder = $fullFolder;

        return $this;
    }

    /**
     * @return int
     */
    public function getFullFolder()
    {
        return $this->fullFolder;
    }

    /**
     * @param int $emailtime
     *
     * @return User
     */
    public function setEmailtime($emailtime)
    {
        $this->emailtime = $emailtime;

        return $this;
    }

    /**
     * @return int
     */
    public function getEmailtime()
    {
        return $this->emailtime;
    }

    /**
     * @param int $topicShowDays
     *
     * @return User
     */
    public function setTopicShowDays($topicShowDays)
    {
        $this->topicShowDays = $topicShowDays;

        return $this;
    }

    /**
     * @return int
     */
    public function getTopicShowDays()
    {
        return $this->topicShowDays;
    }

    /**
     * @param string $topicSortbyType
     *
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
     *
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
     * @param int $postShowDays
     *
     * @return User
     */
    public function setPostShowDays($postShowDays)
    {
        $this->postShowDays = $postShowDays;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostShowDays()
    {
        return $this->postShowDays;
    }

    /**
     * @param string $postSortbyType
     *
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
     *
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
     * @param bool $notify
     *
     * @return User
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;

        return $this;
    }

    /**
     * @return bool
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * @param bool $notifyPm
     *
     * @return User
     */
    public function setNotifyPm($notifyPm)
    {
        $this->notifyPm = $notifyPm;

        return $this;
    }

    /**
     * @return bool
     */
    public function getNotifyPm()
    {
        return $this->notifyPm;
    }

    /**
     * @param bool $notifyType
     *
     * @return User
     */
    public function setNotifyType($notifyType)
    {
        $this->notifyType = $notifyType;

        return $this;
    }

    /**
     * @return bool
     */
    public function getNotifyType()
    {
        return $this->notifyType;
    }

    /**
     * @param bool $allowPm
     *
     * @return User
     */
    public function setAllowPm($allowPm)
    {
        $this->allowPm = $allowPm;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowPm()
    {
        return $this->allowPm;
    }

    /**
     * @param bool $allowViewonline
     *
     * @return User
     */
    public function setAllowViewonline($allowViewonline)
    {
        $this->allowViewonline = $allowViewonline;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowViewonline()
    {
        return $this->allowViewonline;
    }

    /**
     * @param bool $allowViewemail
     *
     * @return User
     */
    public function setAllowViewemail($allowViewemail)
    {
        $this->allowViewemail = $allowViewemail;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowViewemail()
    {
        return $this->allowViewemail;
    }

    /**
     * @param bool $allowMassemail
     *
     * @return User
     */
    public function setAllowMassemail($allowMassemail)
    {
        $this->allowMassemail = $allowMassemail;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowMassemail()
    {
        return $this->allowMassemail;
    }

    /**
     * @param int $options
     *
     * @return User
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $avatar
     *
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
     * @param bool $avatarType
     *
     * @return User
     */
    public function setAvatarType($avatarType)
    {
        $this->avatarType = $avatarType;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAvatarType()
    {
        return $this->avatarType;
    }

    /**
     * @param int $avatarWidth
     *
     * @return User
     */
    public function setAvatarWidth($avatarWidth)
    {
        $this->avatarWidth = $avatarWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvatarWidth()
    {
        return $this->avatarWidth;
    }

    /**
     * @param int $avatarHeight
     *
     * @return User
     */
    public function setAvatarHeight($avatarHeight)
    {
        $this->avatarHeight = $avatarHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvatarHeight()
    {
        return $this->avatarHeight;
    }

    /**
     * @param string $sig
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     * @param bool $new
     *
     * @return User
     */
    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    /**
     * @return bool
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @param bool $reminded
     *
     * @return User
     */
    public function setReminded($reminded)
    {
        $this->reminded = $reminded;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReminded()
    {
        return $this->reminded;
    }

    /**
     * @param int $remindedTime
     *
     * @return User
     */
    public function setRemindedTime($remindedTime)
    {
        $this->remindedTime = $remindedTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getRemindedTime()
    {
        return $this->remindedTime;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

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
    public function getSalt(): ?string
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
    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }
}
