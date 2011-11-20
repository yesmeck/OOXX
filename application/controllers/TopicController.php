<?php

class TopicController extends OOXX_Controller_Action
{

    protected $_topicModel;

    public function init()
    {
        $this->_topicModel = new Application_Model_Topic;
    }
    
    public function getResourceId()
    {
        return 'Topic';
    }
    
    public function setAcl(OOXX_Acl_Interface $acl)
    {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('User', $this, array('new'));
        }
        $this->_acl = $acl;
        return $this;
    }

    public function newAction()
    {
        
        if (!$this->checkAcl('new')) {
            throw new OOXX_Acl_Exception('Insufficient rights');
        }
        
        $form = new Application_Form_Topic();
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $topic = new \OOXX\Entity\Topic;
            
            $this->_topicModel->save($topic, $_POST);
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect('/topic/new');
        }
        
        $this->view->form = $form;
    }

    public function viewAction()
    {
        $topicId = $this->_getParam('topicId');
        
        $this->view->topic = $this->_topicModel->find((int) $topicId);
        
        if (null === $this->view->topic) {
            throw new OOXX_Exception_404('话题不存在');
        }
        
        $this->view->questionForm = new Application_Form_Question(
                $this->view->topic->getId()
        );
        
        
    }

}



