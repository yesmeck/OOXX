<?php

class OOXX_Acl_Role_Admin implements Zend_Acl_Role_Interface
{
    public function getRoleId()
    {
        return 'admin';
    }
}