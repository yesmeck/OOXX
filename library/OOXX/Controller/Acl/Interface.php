<?php

/**
 * OOXX_Controller_Acl_Interface
 *
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

interface OOXX_Controller_Acl_Interface
{
    /**
     * setIdentity
     *
     * @param mixed $identity
     * @access public
     * @return void
     */
    public function setIdentity($identity);
    
    /**
     * getIdentity
     *
     * @access public
     * @return void
     */
    public function getIdentity();
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return void
     */
    public function setAcl(OOXX_Acl_Interface $acl);
    
    /**
     * getAcl
     *
     * @access public
     * @return void
     */
    public function getAcl();
    
    /**
     * checkAcl
     *
     * @param mixed $action
     * @access public
     * @return void
     */
    public function checkAcl($action);
}
