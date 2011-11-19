<?php

class Application_Model_Acl extends Zend_Acl implements OOXX_Acl_Interface
{
    public function __construct()
    {
        $this->addRole(new Application_Model_Acl_Role_Guest);
        $this->addRole(new Application_Model_Acl_Role_User, 'Guest');
        $this->addRole(new Application_Model_Acl_Role_Admin, 'User');
        
        $this->deny();
    }
}