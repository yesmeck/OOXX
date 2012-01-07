<?php

/**
 * User login form
 *
 * @uses Application_Form_User_Base
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Form_User_Login extends Application_Form_User_Base
{

    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setAction('/user/login')
             ->setAttrib('id', 'user-login-form');

        $this->getElement('email')->clearValidators();
        $this->getElement('password')->clearValidators();
        $this->getElement('submit')->setLabel('登录');

        $this->removeElements(array(
            'password2',
            'nickname',
            'introduction',
        ));
    }
}

