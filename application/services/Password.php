<?php

/**
 * Application_Service_Password
 *
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Service_Password
{
    /**
     * Hasher
     *
     * @var OOXX_PasswordHash
     * @access protected
     */
    protected $_hasher;

    public function __construct()
    {
        $this->_hasher = new OOXX_PasswordHash(8, false);
    }


    /**
     * Hash the given string
     *
     * @param string $string
     * @access public
     * @return string
     */
    public function hash($string)
    {
        return $this->_hasher->HashPassword($string);
    }

    /**
     * Compare the twoo string
     *
     * @param mixed $password
     * @param mixed $storedHash
     * @access public
     * @return void
     */
    public function check($password, $storedHash)
    {
        return $this->_hasher->CheckPassword($password, $storedHash);
    }

}

