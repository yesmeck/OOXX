<?php

class OOXX_Acl_Resource_Admin implements Zend_Acl_Resource_Interface
{
    public function getResourceId()
    {
        return 'admin';
    }
}