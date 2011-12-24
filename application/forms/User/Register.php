<?php

class Application_Form_User_Register extends Application_Form_User_Base
{

    public function init()
    {
        parent::init();

        $this->setAction('/user/register')
             ->setAttrib('id', 'user-register-form');

        $this->getElement('email')
             ->addValidator('UniqueEmail', false, array(new Application_Model_User));

        $this->getElement('submit')->setLabel('注册');

        $this->removeElement('introduction');

    }
}

