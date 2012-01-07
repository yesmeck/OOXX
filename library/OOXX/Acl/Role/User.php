<?php

/**
 * OOXX_Acl_Role_User
 *
 * @uses Zend_Acl_Role_Interface
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class OOXX_Acl_Role_User implements Zend_Acl_Role_Interface
{
    /**
     * getRoleId
     *
     * @access public
     * @return string
     */
    public function getRoleId()
    {
        return 'user';
    }
}
