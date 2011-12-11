<?php

class Application_Form_User_Login extends Zend_Form
{

    public function init()
    {

        $this->addElementPrefixPath(
            'OOXX_Validate',
            'OOXX/Validate/',
            'validate'
        );

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
              ->removeDecorator('Label')
              ->addFilter('StringTrim')
              ->addValidator('EmailAddress')
              ->addValidator('StringLength', true, array(3, 128))
              ->setRequired(true);

        $password = new Zend_Form_Element_Password('password');
        $password->setOptions(array('class' => 'xlarge'))
                 ->removeDecorator('Errors')
                 ->removeDecorator('Description')
                 ->removeDecorator('HtmlTag')
                 ->removeDecorator('Label')
                 ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('登录')
               ->setOptions(array('class' => 'btn primary'))
               ->removeDecorator('DtDdWrapper')
               ->setIgnore(true);

        $this->addELement($email)
             ->addELement($password)
             ->addELement($submit);
    }


}

