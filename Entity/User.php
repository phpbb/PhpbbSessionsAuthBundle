<?php
/**
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license MIT
 */

namespace phpBB\SessionsAuthBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'users')]
#[ORM\Entity(readOnly: true)]
class User implements UserInterface
{
    #[ORM\Column(name: 'user_id')]
    #[ORM\Id]
    private ?int $id = null;

    #[ORM\Column(name: 'user_type')]
    private ?bool $type = null;

    #[ORM\Column(name: 'group_id')]
    private ?int $groupId = null;

    #[ORM\Column(name: 'user_permissions', type: Types::TEXT)]
    private ?string $permissions = null;

    #[ORM\Column(name: 'user_perm_from')]
    private ?int $permFrom = null;

    #[ORM\Column(name: 'user_ip', length: 40)]
    private ?string $ip = null;

    #[ORM\Column(name: 'user_regdate')]
    private ?int $regdate = null;

    #[ORM\Column(name: 'username')]
    private ?string $username = null;

    #[ORM\Column(name: 'username_clean')]
    private ?string $nameClean = null;

    #[ORM\Column(name: 'user_password')]
    private ?string $password = null;

    #[ORM\Column(name: 'user_passchg')]
    private ?int $passchg = null;

    #[ORM\Column(name: 'user_email')]
    private ?string $email = null;

    #[ORM\Column(name: 'user_birthday')]
    private ?string $birthday = null;

    #[ORM\Column(name: 'user_lastvisit')]
    private ?int $lastvisit = null;

    #[ORM\Column(name: 'user_lastmark')]
    private ?int $lastmark = null;

    #[ORM\Column(name: 'user_lastpost_time')]
    private ?int $lastpostTime = null;

    #[ORM\Column(name: 'user_lastpage')]
    private ?string $lastpage = null;

    #[ORM\Column(name: 'user_last_confirm_key')]
    private ?string $lastConfirmKey = null;

    #[ORM\Column(name: 'user_last_search')]
    private ?int $lastSearch = null;

    #[ORM\Column(name: 'user_warnings')]
    private ?bool $warnings = null;

    #[ORM\Column(name: 'user_last_warning')]
    private ?int $lastWarning = null;

    #[ORM\Column(name: 'user_login_attempts')]
    private ?bool $loginAttempts = null;

    #[ORM\Column(name: 'user_inactive_reason')]
    private ?bool $inactiveReason = null;

    #[ORM\Column(name: 'user_inactive_time')]
    private ?int $inactiveTime = null;

    #[ORM\Column(name: 'user_posts')]
    private ?int $posts = null;

    #[ORM\Column(name: 'user_lang')]
    private ?string $lang = null;

    #[ORM\Column(name: 'user_timezone')]
    private ?string $timezone = null;

    #[ORM\Column(name: 'user_dateformat')]
    private ?string $dateformat = null;

    #[ORM\Column(name: 'user_style')]
    private ?int $style = null;

    #[ORM\Column(name: 'user_rank')]
    private ?int $rank = null;

    #[ORM\Column(name: 'user_colour')]
    private ?string $colour = null;

    #[ORM\Column(name: 'user_new_privmsg')]
    private ?int $newPrivmsg = null;

    #[ORM\Column(name: 'user_unread_privmsg')]
    private ?int $unreadPrivmsg = null;

    #[ORM\Column(name: 'user_last_privmsg')]
    private ?int $lastPrivmsg = null;

    #[ORM\Column(name: 'user_message_rules')]
    private ?bool $messageRules = null;

    #[ORM\Column(name: 'user_full_folder')]
    private ?int $fullFolder = null;

    #[ORM\Column(name: 'user_emailtime')]
    private ?int $emailtime = null;

    #[ORM\Column(name: 'user_topic_show_days', type: Types::SMALLINT)]
    private ?int $topicShowDays = null;

    #[ORM\Column(name: 'user_topic_sortby_type')]
    private ?string $topicSortbyType = null;

    #[ORM\Column(name: 'user_topic_sortby_dir')]
    private ?string $topicSortbyDir = null;

    #[ORM\Column(name: 'user_post_show_days', type: Types::SMALLINT)]
    private ?int $postShowDays = null;

    #[ORM\Column(name: 'user_post_sortby_type')]
    private ?string $postSortbyType = null;

    #[ORM\Column(name: 'user_post_sortby_dir')]
    private ?string $postSortbyDir = null;

    #[ORM\Column(name: 'user_notify')]
    private ?bool $notify = null;

    #[ORM\Column(name: 'user_notify_pm')]
    private ?bool $notifyPm = null;

    #[ORM\Column(name: 'user_notify_type')]
    private ?bool $notifyType = null;

    #[ORM\Column(name: 'user_allow_pm')]
    private ?bool $allowPm = null;

    #[ORM\Column(name: 'user_allow_viewonline')]
    private ?bool $allowViewonline = null;

    #[ORM\Column(name: 'user_allow_viewemail')]
    private ?bool $allowViewemail = null;

    #[ORM\Column(name: 'user_allow_massemail')]
    private ?bool $allowMassemail = null;

    #[ORM\Column(name: 'user_options')]
    private ?int $options = null;

    #[ORM\Column(name: 'user_avatar')]
    private ?string $avatar = null;

    #[ORM\Column(name: 'user_avatar_type')]
    private ?bool $avatarType = null;

    #[ORM\Column(name: 'user_avatar_width', type: Types::SMALLINT)]
    private ?int $avatarWidth = null;

    #[ORM\Column(name: 'user_avatar_height', type: Types::SMALLINT)]
    private ?int $avatarHeight = null;

    #[ORM\Column(name: 'user_sig', type: Types::TEXT)]
    private ?string $sig = null;

    #[ORM\Column(name: 'user_sig_bbcode_uid')]
    private ?string $sigBbcodeUid = null;

    #[ORM\Column(name: 'user_sig_bbcode_bitfield')]
    private ?string $sigBbcodeBitfield = null;

    #[ORM\Column(name: 'user_jabber')]
    private ?string $jabber = null;

    #[ORM\Column(name: 'user_actkey')]
    private ?string $actkey = null;

    #[ORM\Column(name: 'user_newpasswd')]
    private ?string $newpasswd = null;

    #[ORM\Column(name: 'user_form_salt')]
    private ?string $formSalt = null;

    #[ORM\Column(name: 'user_new')]
    private ?bool $new = null;

    #[ORM\Column(name: 'user_reminded')]
    private ?bool $reminded = null;

    #[ORM\Column(name: 'user_reminded_time')]
    private ?int $remindedTime = null;

    private array $roles = [];

    #[ORM\OneToMany(targetEntity: 'UserGroup', mappedBy: 'user')]
    private Collection $groups;

    #[ORM\OneToMany(targetEntity: 'Session', mappedBy: 'user')]
    private Collection $sessions;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setPermissions(string $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function getPermissions(): ?string
    {
        return $this->permissions;
    }

    public function setPermFrom(int $permFrom): self
    {
        $this->permFrom = $permFrom;

        return $this;
    }

    public function getPermFrom(): ?int
    {
        return $this->permFrom;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setRegdate(int $regdate): self
    {
        $this->regdate = $regdate;

        return $this;
    }

    public function getRegdate(): ?int
    {
        return $this->regdate;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsernameClean(string $usernameClean): self
    {
        $this->nameClean = $usernameClean;

        return $this;
    }

    public function getUsernameClean(): ?string
    {
        return $this->nameClean;
    }

    public function setPassword(string $password): self
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
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPasschg(int $passchg): self
    {
        $this->passchg = $passchg;

        return $this;
    }

    public function getPasschg(): ?int
    {
        return $this->passchg;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setBirthday(string $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setLastvisit(int $lastvisit): self
    {
        $this->lastvisit = $lastvisit;

        return $this;
    }

    public function getLastvisit(): ?int
    {
        return $this->lastvisit;
    }

    public function setLastmark(int $lastmark): self
    {
        $this->lastmark = $lastmark;

        return $this;
    }

    public function getLastmark(): ?int
    {
        return $this->lastmark;
    }

    public function setLastpostTime(int $lastpostTime): self
    {
        $this->lastpostTime = $lastpostTime;

        return $this;
    }

    public function getLastpostTime(): ?int
    {
        return $this->lastpostTime;
    }

    public function setLastpage(string $lastpage): self
    {
        $this->lastpage = $lastpage;

        return $this;
    }

    public function getLastpage(): ?string
    {
        return $this->lastpage;
    }

    public function setLastConfirmKey(string $lastConfirmKey): self
    {
        $this->lastConfirmKey = $lastConfirmKey;

        return $this;
    }

    public function getLastConfirmKey(): ?string
    {
        return $this->lastConfirmKey;
    }

    public function setLastSearch(int $lastSearch): self
    {
        $this->lastSearch = $lastSearch;

        return $this;
    }

    public function getLastSearch(): ?int
    {
        return $this->lastSearch;
    }

    public function setWarnings(bool $warnings): self
    {
        $this->warnings = $warnings;

        return $this;
    }

    public function getWarnings(): ?bool
    {
        return $this->warnings;
    }

    public function setLastWarning(int $lastWarning): self
    {
        $this->lastWarning = $lastWarning;

        return $this;
    }

    public function getLastWarning(): ?int
    {
        return $this->lastWarning;
    }

    public function setLoginAttempts(bool $loginAttempts): self
    {
        $this->loginAttempts = $loginAttempts;

        return $this;
    }

    public function getLoginAttempts(): ?bool
    {
        return $this->loginAttempts;
    }

    public function setInactiveReason(bool $inactiveReason): self
    {
        $this->inactiveReason = $inactiveReason;

        return $this;
    }

    public function getInactiveReason(): ?bool
    {
        return $this->inactiveReason;
    }

    public function setInactiveTime(int $inactiveTime): self
    {
        $this->inactiveTime = $inactiveTime;

        return $this;
    }

    public function getInactiveTime(): ?int
    {
        return $this->inactiveTime;
    }

    public function setPosts(int $posts): self
    {
        $this->posts = $posts;

        return $this;
    }

    public function getPosts(): ?int
    {
        return $this->posts;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setDateformat(string $dateformat): self
    {
        $this->dateformat = $dateformat;

        return $this;
    }

    public function getDateformat(): ?string
    {
        return $this->dateformat;
    }

    public function setStyle(int $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): ?int
    {
        return $this->style;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setNewPrivmsg(int $newPrivmsg): self
    {
        $this->newPrivmsg = $newPrivmsg;

        return $this;
    }

    public function getNewPrivmsg(): ?int
    {
        return $this->newPrivmsg;
    }

    public function setUnreadPrivmsg(int $unreadPrivmsg): self
    {
        $this->unreadPrivmsg = $unreadPrivmsg;

        return $this;
    }

    public function getUnreadPrivmsg(): ?int
    {
        return $this->unreadPrivmsg;
    }

    public function setLastPrivmsg(int $lastPrivmsg): self
    {
        $this->lastPrivmsg = $lastPrivmsg;

        return $this;
    }

    public function getLastPrivmsg(): ?int
    {
        return $this->lastPrivmsg;
    }

    public function setMessageRules(bool $messageRules): self
    {
        $this->messageRules = $messageRules;

        return $this;
    }

    public function getMessageRules(): ?bool
    {
        return $this->messageRules;
    }

    public function setFullFolder(int $fullFolder): self
    {
        $this->fullFolder = $fullFolder;

        return $this;
    }

    public function getFullFolder(): ?int
    {
        return $this->fullFolder;
    }

    public function setEmailtime(int $emailtime): self
    {
        $this->emailtime = $emailtime;

        return $this;
    }

    public function getEmailtime(): ?int
    {
        return $this->emailtime;
    }

    public function setTopicShowDays(int $topicShowDays): self
    {
        $this->topicShowDays = $topicShowDays;

        return $this;
    }

    public function getTopicShowDays(): ?int
    {
        return $this->topicShowDays;
    }

    public function setTopicSortbyType(string $topicSortbyType): self
    {
        $this->topicSortbyType = $topicSortbyType;

        return $this;
    }

    public function getTopicSortbyType(): ?string
    {
        return $this->topicSortbyType;
    }

    public function setTopicSortbyDir(string $topicSortbyDir): self
    {
        $this->topicSortbyDir = $topicSortbyDir;

        return $this;
    }

    public function getTopicSortbyDir(): ?string
    {
        return $this->topicSortbyDir;
    }

    public function setPostShowDays(int $postShowDays): self
    {
        $this->postShowDays = $postShowDays;

        return $this;
    }

    public function getPostShowDays(): ?int
    {
        return $this->postShowDays;
    }

    public function setPostSortbyType(string $postSortbyType): self
    {
        $this->postSortbyType = $postSortbyType;

        return $this;
    }

    public function getPostSortbyType(): ?string
    {
        return $this->postSortbyType;
    }

    public function setPostSortbyDir(string $postSortbyDir): self
    {
        $this->postSortbyDir = $postSortbyDir;

        return $this;
    }

    public function getPostSortbyDir(): ?string
    {
        return $this->postSortbyDir;
    }

    public function setNotify(bool $notify): self
    {
        $this->notify = $notify;

        return $this;
    }

    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    public function setNotifyPm(bool $notifyPm): self
    {
        $this->notifyPm = $notifyPm;

        return $this;
    }

    public function getNotifyPm(): ?bool
    {
        return $this->notifyPm;
    }

    public function setNotifyType(bool $notifyType): self
    {
        $this->notifyType = $notifyType;

        return $this;
    }

    public function getNotifyType(): ?bool
    {
        return $this->notifyType;
    }

    public function setAllowPm(bool $allowPm): self
    {
        $this->allowPm = $allowPm;

        return $this;
    }

    public function getAllowPm(): ?bool
    {
        return $this->allowPm;
    }

    public function setAllowViewonline(bool $allowViewonline): self
    {
        $this->allowViewonline = $allowViewonline;

        return $this;
    }

    public function getAllowViewonline(): ?bool
    {
        return $this->allowViewonline;
    }

    public function setAllowViewemail(bool $allowViewemail): self
    {
        $this->allowViewemail = $allowViewemail;

        return $this;
    }

    public function getAllowViewemail(): ?bool
    {
        return $this->allowViewemail;
    }

    public function setAllowMassemail(bool $allowMassemail): self
    {
        $this->allowMassemail = $allowMassemail;

        return $this;
    }

    public function getAllowMassemail(): ?bool
    {
        return $this->allowMassemail;
    }

    public function setOptions(int $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): ?int
    {
        return $this->options;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatarType(bool $avatarType): self
    {
        $this->avatarType = $avatarType;

        return $this;
    }

    public function getAvatarType(): ?bool
    {
        return $this->avatarType;
    }

    public function setAvatarWidth(int $avatarWidth): self
    {
        $this->avatarWidth = $avatarWidth;

        return $this;
    }

    public function getAvatarWidth(): ?int
    {
        return $this->avatarWidth;
    }

    public function setAvatarHeight(int $avatarHeight): self
    {
        $this->avatarHeight = $avatarHeight;

        return $this;
    }

    public function getAvatarHeight(): ?int
    {
        return $this->avatarHeight;
    }

    public function setSig(string $sig): self
    {
        $this->sig = $sig;

        return $this;
    }

    public function getSig(): ?string
    {
        return $this->sig;
    }

    public function setSigBbcodeUid(string $sigBbcodeUid): self
    {
        $this->sigBbcodeUid = $sigBbcodeUid;

        return $this;
    }

    public function getSigBbcodeUid(): ?string
    {
        return $this->sigBbcodeUid;
    }

    public function setSigBbcodeBitfield(string $sigBbcodeBitfield): self
    {
        $this->sigBbcodeBitfield = $sigBbcodeBitfield;

        return $this;
    }

    public function getSigBbcodeBitfield(): ?string
    {
        return $this->sigBbcodeBitfield;
    }

    public function setJabber(string $jabber): self
    {
        $this->jabber = $jabber;

        return $this;
    }

    public function getJabber(): ?string
    {
        return $this->jabber;
    }

    public function setActkey(string $actkey): self
    {
        $this->actkey = $actkey;

        return $this;
    }

    public function getActkey(): ?string
    {
        return $this->actkey;
    }

    public function setNewpasswd(string $newpasswd): self
    {
        $this->newpasswd = $newpasswd;

        return $this;
    }

    public function getNewpasswd(): ?string
    {
        return $this->newpasswd;
    }

    public function setFormSalt(string $formSalt): self
    {
        $this->formSalt = $formSalt;

        return $this;
    }

    public function getFormSalt(): ?string
    {
        return $this->formSalt;
    }

    public function setNew(bool $new): self
    {
        $this->new = $new;

        return $this;
    }

    public function getNew(): ?bool
    {
        return $this->new;
    }

    public function setReminded(bool $reminded): self
    {
        $this->reminded = $reminded;

        return $this;
    }

    public function getReminded(): ?bool
    {
        return $this->reminded;
    }

    public function setRemindedTime(int $remindedTime): self
    {
        $this->remindedTime = $remindedTime;

        return $this;
    }

    public function getRemindedTime(): ?int
    {
        return $this->remindedTime;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function setGroups(Collection $groups): self
    {
        $this->groups = $groups;

        return $this;
    }

    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function setSessions(Collection $sessions): self
    {
        $this->sessions = $sessions;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }
}
