<?php

class Application_Form_Topic extends Zend_Form
{

    public function init()
    {
        $this->setAction('/topic/new')
             ->setMethod('post')
             ->setAttrib('id', 'new-topic-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'topic/_form.phtml')),
            'Form'
        ));
        
    }


}

