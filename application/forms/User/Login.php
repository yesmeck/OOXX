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
            'Form',
        ));

        $email = new Zend_Form_Element_Text('email');
        $email->setOptions(array('class' => 'xlarge'))
              ->removeDecorator('Errors')
              ->removeDecorator('Description')
              ->removeDecorator('HtmlTag')
              ->removeDecorator('Label');

        $password = new Zend_Form_Element_Password('password');
        $password->setOptions(array('class' => 'xlarge'))
                 ->removeDecorator('Errors')
                 ->removeDecorator('Description')
                 ->removeDecorator('HtmlTag')
                 ->removeDecorator('Label');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('登录')
               ->setOptions(array('class' => 'btn primary'))
               ->removeDecorator('DtDdWrapper');

        $this->addELement($email)
             ->addELement($password)
             ->addELement($submit);
    }


}

