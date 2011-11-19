<?php

class TopicController extends Zend_Controller_Action
{

    protected $_topicModel;

    public function init()
    {
        $this->_topicModel = new Application_Model_Topic;
    }

    public function indexAction()
    {
        // action body
    }

    public function newAction()
    {
        $form = new Application_Form_Topic();
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $topic = new \OOXX\Entity\Topic;
            
            $this->_topicModel->save($topic, $_POST);
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect('/topic/new');
        }
        
        $this->view->form = $form;
    }


}



