<?php

/**
 * User setting form
 *
 * @uses Application_Form_User_Base
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Form_User_Settings extends Application_Form_User_Base
{
    public function init()
    {
        parent::init();

        $this->setAction('/user/settings')
             ->setAttrib('id', 'user-settings-form');

        $this->getElement('password')->setRequired(false);
        $this->getElement('password2')->setRequired(false);

    }
}

