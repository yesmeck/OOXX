<?php

class Application_Form_User_Login extends Zend_Form
{

    public function init()
    {
        $this->setAction('/user/login')
             ->setMethod('post')
             ->setAttrib('id', 'user-login-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'user/form/_login.phtml')),
            'Form'
        ));
    }


}

