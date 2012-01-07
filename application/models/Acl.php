<?php

/**
 * Application_Model_Acl
 *
 * @uses Zend_Acl
 * @implements OOXX_Acl_Interface
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_Acl extends Zend_Acl implements OOXX_Acl_Interface
{
    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->addRole(new Application_Model_Acl_Role_Guest);
        $this->addRole(new Application_Model_Acl_Role_User, 'Guest');
        $this->addRole(new Application_Model_Acl_Role_Admin, 'User');
        
        $this->deny();
    }
}

