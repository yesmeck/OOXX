<?php

/**
 * Application_Service_Password
 *
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */
class Application_Service_Password
{
    protected $_hasher;

    public function __construct()
    {
        $this->_hasher = new OOXX_PasswordHash(8, false);
    }


    /**
     * hash
     *
     * @param string $string
     * @access public
     * @return string
     */
    public function hash($string)
    {
        return $this->_hasher->HashPassword($string);
    }

    public function check($password, $storedHash)
    {
        return $this->_hasher->CheckPassword($password, $storedHash);
    }


}
