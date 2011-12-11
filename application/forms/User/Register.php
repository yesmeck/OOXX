<?php

class Application_Form_User_Register extends Application_Form_User_Login
{

    public function init()
    {
        parent::init();

        $this->setAction('/user/register')
             ->setAttrib('id', 'user-register-form');

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'user/form/_register.phtml')),
            'Form'
        ));


        $password2 = new Zend_Form_Element_Password('password2');
        $password2->setOptions(array('class' => 'xlarge'))
                  ->removeDecorator('Errors')
                  ->removeDecorator('Description')
                  ->removeDecorator('HtmlTag')
                  ->removeDecorator('Label');

        $nickname = new Zend_Form_Element_Text('nickname');
        $nickname->setOptions(array('class' => 'xlarge'))
                 ->removeDecorator('Errors')
                 ->removeDecorator('Description')
                 ->removeDecorator('HtmlTag')
                 ->removeDecorator('Label');


        $this->getElement('submit')->setLabel('登录');

        $this->addELement($password2)
             ->addELement($nickname);
    }
}
