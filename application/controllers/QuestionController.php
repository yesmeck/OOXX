<?php

class QuestionController extends OOXX_Controller_Action_Abstract
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

        $topicId = $this->getRequest()->getPost('topicId');
        
        $form = new Application_Form_Question($topicId);
        
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
            $this->_questionModel->save($form->getValues());
        
        $this->_redirect(
            $this->view->url(array(
                'topicId' => $topicId,
            ), 'topicView', true)
        );
    }
}
