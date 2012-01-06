<?php

class Application_Form_Question extends OOXX_Form
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
             ->setAttrib('id', 'new-question-form');

        $this->addELements(array(
            $this->createElement('text', 'content')
                 ->setDescription('140字以内')
                 ->setRequired(true)
                 ->removeDecorator('Label')
                 ->removeDecorator('Wrapper'),

            $this->createElement('hidden', 'topicId')
                 ->setValue($this->_topicId)
                 ->setRequired(true)
                 ->clearDecorators()
                 ->addDecorator('ViewHelper'),

            $this->createElement('submit', 'submit')
                 ->setLabel('提问')
                 ->setOptions(array('class' => 'btn primary'))
                 ->setIgnore(true)
                 ->removeDecorator('Wrapper')
                 ->removeDecorator('Label'),
        ));
    }
}
