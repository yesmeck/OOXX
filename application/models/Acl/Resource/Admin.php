<?php

/**
 * Application_Model_Acl_Resource_Admin
 *
 * @uses Zend_Acl_Resource_Interface
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_Acl_Resource_Admin implements Zend_Acl_Resource_Interface
{
    /**
     * getResourceId
     *
     * @access public
     * @return void
     */
    public function getResourceId()
    {
        return 'Admin';
    }
}

