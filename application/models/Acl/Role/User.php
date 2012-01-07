<?php

/**
 * Application_Model_Acl_Role_User
 *
 * @uses Zend_Acl_Role_Interface
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_Acl_Role_User implements Zend_Acl_Role_Interface
{
    /**
     * getRoleId
     *
     * @access public
     * @return void
     */
    public function getRoleId()
    {
        return 'User';
    }
}

