<?php

class Application_Form_User_Settings extends Application_Form_User_Base
{
    public function init()
    {
        parent::init();

        $this->setAction('/user/settings')
             ->setAttrib('id', 'user-settings-form');

    }
}
