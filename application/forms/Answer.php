<?php

class Application_Form_Answer extends Zend_Form
{    
    public function init()
    {

        $this->setAction('')
             ->setMethod('post')
             ->setAttrib('id', 'new-answer-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'answer/_form.phtml')),
            'Form'
        ));
    }
}