<?php

class Application_Form_User_Register extends Application_Form_User_Login
{

    public function init()
    {
        parent::init();

        $this->setAction('/user/register')
             ->setAttrib('id', 'user-register-form');

        $this->getElement('email')
             ->addValidator('UniqueEmail', false, array(new Application_Model_User));

        $password2 = new Zend_Form_Element_Password('password2');
        $password2->setLabel('确认密码')
                  ->setOptions(array('class' => 'xlarge'))
                  ->clearDecorators()
                  ->addValidator('identical', false, array('token' => 'password'))
                  ->setRequired(true);

        $nickname = new Zend_Form_Element_Text('nickname');
        $nickname->setLabel('名号')
                 ->setOptions(array('class' => 'xlarge'))
                 ->clearDecorators()
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', true, array(1, 16, 'utf8'))
                 ->setRequired(true);


        $this->getElement('submit')->setLabel('注册');

        $this->addELement($password2)
             ->addELement($nickname);
    }
}

