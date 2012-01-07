<?php

/**
 * Vote controller
 *
 * @uses OOXX_Controller_Action_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class VoteController extends OOXX_Controller_Action_Abstract
{
    
    /**
     * Vote model
     *
     * @var Application_Model_Vote
     * @access protected
     */
    protected $_voteModel;

    /**
     * Question model
     *
     * @var Application_Model_Question
     * @access protected
     */
    protected $_questionModel;

    /**
     * User model
     *
     * @var Application_Model_User
     * @access protected
     */
    protected $_userModel;


    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_voteModel = new Application_Model_Vote;
        $this->_questionModel = new Application_Model_Question;
        $this->_userModel = new Application_Model_User;
        
        //We should disable layout for AJAX!
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }


    /**
     * getResourceId
     *
     * @access public
     * @return string
     */
    public function getResourceId()
    {
        return 'Vote';
    }
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return VoteController
     */
    public function setAcl(OOXX_Acl_Interface $acl)
    {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('User', $this, array('index'));
        }
        $this->_acl = $acl;
        return $this;
    }
    
    /**
     * Index action
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        $type = $this->getRequest()->getParam('type');
        $questionId = $this->getRequest()->getParam('qid');
        
        $quesiton = $this->_questionModel->find($questionId);
        $user = $this->_userModel->find(Zend_Registry::get('authUser')->getId());
        
        $response = array(
            'error' => 'unknow',
        );

        switch ($type) {
            case 'down':
            case 'up':
                if (null == $this->_voteModel->getVoteToQuestionByUser($quesiton, $user, $type)) {
                    $this->_voteModel->add($quesiton, $user, $type);
                    $response = array(
                        'voteCount' => $quesiton->getVoteCount()
                    );
                } else {
                    $response = array(
                        'error' => 'voted'
                    );
                }
                break;
            case 'undown':
            case 'unup':
                $type = str_replace('un', '', $type);
                if (null == ($vote = $this->_voteModel->getVoteToQuestionByUser($quesiton, $user, $type))) {
                    $response = array(
                        'error' => 'voted'
                    );
                } else {
                    $this->_voteModel->delete($vote);
                    $response = array(
                        'voteCount' => $quesiton->getVoteCount()
                    );
                }
                break;
        }
        

        
        $this->getResponse()->setHeader('Content-Type', 'application/json')
                            ->appendBody(Zend_Json::encode($response));
    }
}

