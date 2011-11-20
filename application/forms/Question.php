<?php

class Application_Form_Question extends Zend_Form
{
    
    protected $_topicId;
    
    public function __construct($topicId, $options = null) {
        $this->_topicId = $topicId;
        parent::__construct($options);
    }

    public function init()
    {
        $this->setAction('/question/new')
             ->setMethod('post')
             ->setAttrib('id', 'new-question-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'question/_form.phtml')),
            'Form'
        ));
        
        $this->addElement('hidden', 'topicId', array(
            'value'    => $this->_topicId,
            'required' => true,
        ));
    }
}