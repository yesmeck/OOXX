<?php

class Application_Form_User_Login extends OOXX_Form
{

    public function init()
    {

        $this->setAction('/user/login')
             ->setMethod('post')
             ->setAttrib('id', 'user-login-form');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('邮箱')
              ->setOptions(array('class' => 'xlarge'))
              ->clearDecorators()
              ->addFilter('StringTrim')
              ->addValidator('EmailAddress')
              ->addValidator('StringLength', true, array(3, 128))
              ->setRequired(true);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('密码')
                 ->clearDecorators()
                 ->setOptions(array('class' => 'xlarge'))
                 ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('登录')
               ->setOptions(array('class' => 'btn primary'))
               ->clearDecorators()
               ->setIgnore(true)
               ->setOrder(100);

//       Zend_Debug::dump($submit->getDecorators());

        $this->addELement($email)
             ->addELement($password)
             ->addELement($submit);
    }


}

