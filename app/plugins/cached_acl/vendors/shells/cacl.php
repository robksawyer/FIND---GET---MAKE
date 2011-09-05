<?php
/**
 * Cached Acl Shell provides Acl access in the CLI environment
 *
 * An extension to the ACL Shell that supports caching.
 *
 * PHP version 5
 *
 * Copyright (c) 2011, George C. <slygoncito@gmail.com>
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      George C. <slygoncito@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link        http://github.com/slygoncito/cakephp_cached_acl/
 */

/**
 * Acl Shell provides Acl access in the CLI environment
 */
App::import('Shell', 'Acl');

/**
 * Cached Acl Shell provides Acl access in the CLI environment
 *
 * An extension to the ACL Shell that supports caching.
 */
class CaclShell extends AclShell
{
    /**
     * Override startup of the Shell
     *
     * @access public
     */
    function startup()
    {
        if (isset($this->params['connection']))
        {
            $this->connection = $this->params['connection'];
        }

        if (!in_array(Configure::read('Acl.classname'), array('DbAcl', 'DB_ACL', 'Cached_Acl.Db_Cached_Acl', 'db_cached_acl')))
        {
            $out = "--------------------------------------------------\n";
            $out .= __("Error: Your current Cake configuration is set to", true) . "\n";
            $out .= __("an ACL implementation other than DB. Please change", true) . "\n";
            $out .= __("your core config to reflect your decision to use", true) . "\n";
            $out .= __("DbAcl before attempting to use this script", true) . ".\n";
            $out .= "--------------------------------------------------\n";
            $out .= sprintf(__("Current ACL Classname: %s", true), Configure::read('Acl.classname')) . "\n";
            $out .= "--------------------------------------------------\n";
            $this->err($out);
            $this->_stop();
        }

        if ($this->command && !in_array($this->command, array('help')))
        {
            if (!config('database'))
            {
                $this->out(__("Your database configuration was not found. Take a moment to create one.", true), true);
                $this->args = null;
                return $this->DbConfig->execute();
            }
            require_once (CONFIGS . 'database.php');

            if (!in_array($this->command, array('initdb')))
            {
                $this->Acl = & new AclComponent();
                $controller = null;
                $this->Acl->startup($controller);
            }
        }
    }
}