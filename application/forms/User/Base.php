<?php

/**
 * Application_Form_User_Base
 *
 * @uses OOXX_Form
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */
class Application_Form_User_Base extends OOXX_Form
{
    public function init()
    {
        $this->setMethod('post');

        $elements = array();

        $elements['email'] = new Zend_Form_Element_Text('email');
        $elements['email']->setLabel('邮箱')
                          ->setOptions(array('class' => 'xlarge'))
                          ->clearDecorators()
                          ->addFilter('StringTrim')
                          ->addValidator('EmailAddress')
                          ->addValidator('StringLength', true, array(3, 128))
                          ->setRequired(true);

        $elements['password'] = new Zend_Form_Element_Password('password');
        $elements['password']->setLabel('密码')
                             ->clearDecorators()
                             ->setOptions(array('class' => 'xlarge'))
                             ->setRequired(true);

        $elements['password2'] = new Zend_Form_Element_Password('password2');
        $elements['password2']->setLabel('确认密码')
                              ->setOptions(array('class' => 'xlarge'))
                              ->clearDecorators()
                              ->addValidator('identical', false, array(
                                  'token' => 'password'
                              ))
                              ->setRequired(true);

        $elements['nickname'] = new Zend_Form_Element_Text('nickname');
        $elements['nickname']->setLabel('名号')
                             ->setOptions(array('class' => 'xlarge'))
                             ->clearDecorators()
                             ->addFilter('StringTrim')
                             ->addValidator('StringLength', true, array(
                                 1,
                                 16,
                                 'utf8'
                             ))
                             ->setRequired(true);

        $elements['introduction'] = new Zend_Form_Element_Textarea('introduction');
        $elements['introduction']->setLabel('个人介绍')
                                 ->setOptions(array(
                                     'class'    => 'xlarge',
                                     'rows'     => 5,
                                 ))
                                 ->clearDecorators();

        $elements['submit'] = new Zend_Form_Element_Submit('submit');
        $elements['submit']->setLabel('提交')
                           ->setOptions(array('class' => 'btn primary'))
                           ->clearDecorators()
                           ->setIgnore(true)
                           ->setOrder(100);

        $this->addELements($elements);
    }

}
