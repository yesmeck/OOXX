<?php

class Application_Form_UserTopLogin extends Zend_Form
{

    public function init()
    {
        $this->setAction('/user/login')
             ->setMethod('post')
             ->setAttrib('id', 'user-top-login-form')
             ->setAttrib('class', 'pull-right')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'user/_top_login_form.phtml')),
            'Form'
        ));
    }


}

