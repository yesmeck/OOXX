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

        $this->addELements(array(
            $this->createElement('text', 'email')
                 ->setLabel('邮箱')
                 ->setOptions(array('class' => 'xlarge'))
                 ->addFilter('StringTrim')
                 ->addValidator('EmailAddress')
                 ->addValidator('StringLength', true, array(3, 128))
                 ->setRequired(true),

            $this->createElement('password', 'password')
                 ->setLabel('密码')
                 ->setOptions(array('class' => 'xlarge'))
                 ->setRequired(true),

            $this->createElement('password', 'password2')
                 ->setLabel('确认密码')
                 ->setOptions(array('class' => 'xlarge'))
                 ->addValidator('identical', false, array(
                     'token' => 'password'
                 ))
                 ->setRequired(true),

            $this->createElement('text', 'nickname')
                 ->setLabel('名号')
                 ->setOptions(array('class' => 'xlarge'))
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', true, array(
                     1,
                     16,
                     'utf8'
                 ))
                 ->setRequired(true),

            $this->createElement('textarea', 'introduction')
                 ->setLabel('个人介绍')
                 ->setOptions(array(
                     'class'    => 'xlarge',
                     'rows'     => 5,
                 )),

            $this->createElement('submit', 'submit')
                 ->setLabel('提交')
                 ->setOptions(array('class' => 'btn primary'))
                 ->setIgnore(true)
                 ->setOrder(100),
        ));
    }
}
