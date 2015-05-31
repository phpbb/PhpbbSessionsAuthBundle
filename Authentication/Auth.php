<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

namespace phpBB\SessionsAuthBundle\Authentication;

/**
 * Permission/Auth class
 *
 * This is a copy based on the original phpBB Auth class. It has been modified to work with
 * Doctrine entities for the ACL_OPTIONS_TABLE, and all unneeded stuff has been removed.
 *
 * This version does not support recreating the user_permissions field in the user table.
 * If there is no user_permissions field, it will result in a exception.
 *
 */
class Auth
{
    private $acl         = array();
    private $cache       = array();
    private $aclOptions  = array();
    private $aclForumIds = false;

    /**
     * Init permissions
     * @param $userPermissions string
     * @throws \Exception
     */
    public function acl($userPermissions)
    {
        $this->acl         = array();
        $this->cache       = array();
        $this->aclOptions  = array();
        $this->aclForumIds = false;

        if (($this->aclOptions = $cache->get('_acl_options')) === false)
        {
            $sql = 'SELECT auth_option_id, auth_option, is_global, is_local
				FROM ' . ACL_OPTIONS_TABLE . '
				ORDER BY auth_option_id';
            $result = $db->sql_query($sql);

            $global = 0;
            $local  = 0;
            $this->aclOptions = array();
            while ($row = $db->sql_fetchrow($result))
            {
                if ($row['is_global'])
                {
                    $this->aclOptions['global'][$row['auth_option']] = $global++;
                }

                if ($row['is_local'])
                {
                    $this->aclOptions['local'][$row['auth_option']] = $local++;
                }

                $this->aclOptions['id'][$row['auth_option']]              = (int) $row['auth_option_id'];
                $this->aclOptions['option'][(int) $row['auth_option_id']] = $row['auth_option'];
            }
            $db->sql_freeresult($result);

            $cache->put('_acl_options', $this->aclOptions);
        }

        if (!trim($userPermissions))
        {
            throw new \Exception('We require user_permissions set by phpBB.');
        }

        // Fill ACL array
        $this->_fill_acl($userPermissions);

        // Verify bitstring length with options provided...
        $renew         = false;
        $global_length = sizeof($this->aclOptions['global']);
        $local_length  = sizeof($this->aclOptions['local']);

        // Specify comparing length (bitstring is padded to 31 bits)
        $global_length = ($global_length % 31) ? ($global_length - ($global_length % 31) + 31) : $global_length;
        $local_length  = ($local_length % 31) ? ($local_length - ($local_length % 31) + 31) : $local_length;

        // You thought we are finished now? Noooo... now compare them.
        foreach ($this->acl as $forum_id => $bitstring)
        {
            if (($forum_id && strlen($bitstring) != $local_length) || (!$forum_id && strlen($bitstring) != $global_length))
            {
                $renew = true;
                break;
            }
        }

        // If a bitstring within the list does not match the options, we have a user with incorrect permissions set and need to renew them
        if ($renew)
        {
            throw new \Exception('Renewing is not supported.');
        }

        return;
    }

    /**
     * Fill ACL array with relevant bitstrings from user_permissions column
     * @param $userPermissions
     */
    private function _fill_acl($userPermissions)
    {
        $seq_cache       = array();
        $this->acl       = array();
        $userPermissions = explode("\n", $userPermissions);

        foreach ($userPermissions as $f => $seq)
        {
            if ($seq)
            {
                $i = 0;

                if (!isset($this->acl[$f]))
                {
                    $this->acl[$f] = '';
                }

                while ($subseq = substr($seq, $i, 6))
                {
                    if (isset($seq_cache[$subseq]))
                    {
                        $converted = $seq_cache[$subseq];
                    }
                    else
                    {
                        $result             = str_pad(base_convert($subseq, 36, 2), 31, 0, STR_PAD_LEFT);
                        $converted          = $result;
                        $seq_cache[$subseq] = $result;
                    }

                    // We put the original bitstring into the acl array
                    $this->acl[$f] .= $converted;
                    $i             += 6;
                }
            }
        }
    }

    /**
     * Look up an option
     * if the option is prefixed with !, then the result becomes negated
     *
     * If a forum id is specified the local option will be combined with a global option if one exist.
     * If a forum id is not specified, only the global option will be checked.
     * @param $opt string option
     * @param int $forumId int forum_id
     * @return bool
     */
    public function aclGet($opt, $forumId = 0)
    {
        $negate = false;

        if (strpos($opt, '!') === 0)
        {
            $negate = true;
            $opt    = substr($opt, 1);
        }

        if (!isset($this->cache[$forumId][$opt]))
        {
            // We combine the global/local option with an OR because some options are global and local.
            // If the user has the global permission the local one is true too and vice versa
            $this->cache[$forumId][$opt] = false;

            // Is this option a global permission setting?
            if (isset($this->aclOptions['global'][$opt]))
            {
                if (isset($this->acl[0]))
                {
                    $this->cache[$forumId][$opt] = $this->acl[0][$this->aclOptions['global'][$opt]];
                }
            }

            // Is this option a local permission setting?
            // But if we check for a global option only, we won't combine the options...
            if ($forumId != 0 && isset($this->aclOptions['local'][$opt]))
            {
                if (isset($this->acl[$forumId]) && isset($this->acl[$forumId][$this->aclOptions['local'][$opt]]))
                {
                    $this->cache[$forumId][$opt] |= $this->acl[$forumId][$this->aclOptions['local'][$opt]];
                }
            }
        }

        // Founder always has all global options set to true...
        return ($negate) ? !$this->cache[$forumId][$opt] : $this->cache[$forumId][$opt];
    }
}