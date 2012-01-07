<?php

/**
 * Topic controller
 *
 * @uses OOXX_Controller_Action_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class TopicController extends OOXX_Controller_Action_Abstract
{

    /**
     * Topic model
     *
     * @var Application_Model_Topic
     * @access protected
     */
    protected $_topicModel;

    /**
     * Question model
     *
     * @var Application_Model_Question
     * @access protected
     */
    protected $_questionModel;

    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_topicModel = new Application_Model_Topic;
        $this->_questionModel = new Application_Model_Question;
    }
    
    /**
     * getResourceId
     *
     * @access public
     * @return string
     */
    public function getResourceId()
    {
        return 'Topic';
    }
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return TopicController
     */
    public function setAcl(OOXX_Acl_Interface $acl)
    {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('User', $this, array('new'));
        }
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Create new topic
     *
     * @access public
     * @return void
     */
    public function newAction()
    {
        
        if (!$this->checkAcl('new')) {
            throw new OOXX_Acl_Exception('Insufficient rights');
        }
        
        $form = new Application_Form_Topic();
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $this->_topicModel->save($_POST);
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect('/topic/new');
        }
        
        $this->view->form = $form;
    }

    /**
     * Topic view
     *
     * @access public
     * @return void
     */
    public function viewAction()
    {
        $topicId = $this->_getParam('topicId');
        
        $this->view->topic = $topic = $this->_topicModel->find((int) $topicId);
        
        if (null === $this->view->topic) {
            throw new OOXX_Exception_404('话题不存在');
        }
        
        $this->view->questionForm = new Application_Form_Question(
                $topic->getId()
        );
        
        $this->view->answeredQuestions = $this->_questionModel
                                        ->getAnsweredQuestions($topic);
        
        $this->view->unansweredQuestions = $this->_questionModel
                                                ->getUnansweredQuestions($topic);
    }

}

