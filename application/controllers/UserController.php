<?php

/**
 * User controller
 *
 * @uses OOXX_Controller_Action_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class UserController extends OOXX_Controller_Action_Abstract
{

    /**
     * User model
     *
     * @var Application_Model_User
     * @access protected
     */
    protected $_userModel;
    
    /**
     * Authenticate service
     *
     * @var Application_Service_Authentication
     * @access protected
     */
    protected $_authService;

    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_userModel = new Application_Model_User;
        $this->_authService = new Application_Service_Authentication;
    }
    
    
    /**
     * getResourceId
     *
     * @access public
     * @return string
     */
    public function getResourceId()
    {
        return 'User';
    }
    
    /**
     * setAcl
     *
     * @param OOXX_Acl_Interface $acl
     * @access public
     * @return UserController
     */
    public function setAcl(OOXX_Acl_Interface $acl)
    {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('Guest', $this, array('register'));
        }
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Register a new user
     *
     * @access public
     * @return void
     */
    public function registerAction()
    {
        $form = new Application_Form_User_Register;
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                $this->_userModel->save(new \OOXX\Entity\User, $form->getValues());
                return $this->_redirect('/');
            } else {
                $this->view->errorMessages = $form->getMessages();
            }
        }
        
        $this->view->registerForm = $form;
    }

    /**
     * User login
     *
     * @access public
     * @return void
     */
    public function loginAction()
    {
        
        $form = new Application_Form_User_Login;
        
        $request = $this->getRequest();

        if ($request->isPost() && $form->isValid($request->getPost())) {

            $result = $this->_authService->authenticate($request->getPost());

            switch ($result->getCode()) {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    $form->getElement('email')
                         ->setErrorMessages($result->getMessages())
                         ->markAsError();
                    break;
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    $form->getElement('password')
                         ->setErrorMessages($result->getMessages())
                         ->markAsError();
                    break;
                case Zend_Auth_Result::SUCCESS:
                    $this->_redirect('/');
                    break;
            }
        }

        $this->view->form = $form;
    }

    /**
     * Bye bye~
     *
     * @access public
     * @return void
     */
    public function logoutAction()
    {
        $this->_authService->clear();
        return $this->_redirect('/');
    }

    /**
     * User setting
     *
     * @access public
     * @return void
     */
    public function settingsAction()
    {
        $form       = new Application_Form_User_Settings;
        $user       = $this->_userModel->find(Zend_Registry::get('authUser')->getId());
        $request    = $this->getRequest();

        if ($request->isPost() && $form->isValid($request->getPost())) {
            $this->_userModel->save($user, $form->getValues());
        }

        $form->getElement('email')
             ->setValue($user->getEmail());

        $form->getElement('nickname')
             ->setValue($user->getNickname());

        $form->getElement('introduction')
             ->setValue($user->getIntroduction());

        $this->view->form = $form;
    }


}

