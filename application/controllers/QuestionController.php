<?php

class QuestionController extends OOXX_Controller_Action
{
    
    protected $_questionModel;
    
    public function init()
    {
        $this->_questionModel = new Application_Model_Question;
    }


    public function getResourceId()
    {
        return 'Question';
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
        
        $form = new Application_Form_Question;
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $this->_questionModel->save($_POST);
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect(
                $this->view->url(array(
                    'topicId' => $_POST['topicId'],
                ), 'topicView', true)
            );
        }
        
    }
}