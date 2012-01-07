<?php

/**
 * Answer controller
 *
 * @uses OOXX_Controller_Action_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class AnswerController extends OOXX_Controller_Action_Abstract
{
    /**
     * Question model
     *
     * @var Application_Model_Question
     * @access protected
     */
    protected $_questionModel;

    /**
     * Answer model
     *
     * @var Application_Model_Answer
     * @access protected
     */
    protected $_answerModel;

    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_questionModel = new Application_Model_Question;
        $this->_answerModel = new Application_Model_Answer;
    }


    /**
     * getResourceId
     *
     * @access public
     * @return String
     */
    public function getResourceId()
    {
        return 'Answer';
    }
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return AnswerController
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
     * Create new answer
     *
     * @access public
     * @return void
     */
    public function newAction()
    {
        $questionId = $this->getRequest()->getParam('questionId');
        
        $question = $this->_questionModel->find($questionId);
        if (null === $question) {
            throw  new OOXX_Exception_404('话题不存在');
        }
        
        $topic = $question->getTopic();
        if (!$topic->isBelongTo(Zend_Registry::get('authUser'))) {
            throw new OOXX_Exception('无权访问该页面');
        }
        
        $form = new Application_Form_Answer;
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $this->_answerModel->save($_POST, $question);
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect($this->view->url(array(
                'topicId' => $topic->getId()
            ), 'topicView', true));
        }
        
        $this->view->form = $form;
        $this->view->question = $question;
    }
}

