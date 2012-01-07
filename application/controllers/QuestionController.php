<?php

/**
 * Question controller
 *
 * @uses OOXX_Controller_Action_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class QuestionController extends OOXX_Controller_Action_Abstract
{
    
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
        return 'Question';
    }
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return QuestionController
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
     * Create new question
     *
     * @access public
     * @return void
     */
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

