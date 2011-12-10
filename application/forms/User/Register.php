<?php

class Application_Form_User_Register extends Zend_Form
{

    public function init()
    {
        $this->setAction('/user/register')
             ->setMethod('post')
             ->setAttrib('id', 'user-register-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'user/form/_register.phtml')),
            'Form'
        ));
    }


}

