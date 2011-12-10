<?php

class Application_Form_User_Settings extends Zend_Form
{
    public function init()
    {
        $this->setAction('/user/settings')
             ->setMethod('post')
             ->setAttrib('id', 'user-settings-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'user/form/_settings.phtml')),
            'Form'
        ));
    }
}
