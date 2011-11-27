<?php

class UserController extends Zend_Controller_Action
{

    protected $_userModel;
    
    /**
     *
     * @var Application_Service_Authentication 
     */
    protected $_authService;

    public function init()
    {
        $this->_userModel = new Application_Model_User;
        $this->_authService = new Application_Service_Authentication;
    }
    
    
    public function getResourceId()
    {
        return 'User';
    }
    
    public function setAcl(OOXX_Acl_Interface $acl)
    {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('Guest', $this, array('register'));
        }
        $this->_acl = $acl;
        return $this;
    }

    public function indexAction()
    {
        // action body
    }

    public function registerAction()
    {
        $form = new Application_Form_UserRegister;
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $this->_userModel->save($_POST);
    
            $this->_helper->flashMessenger->addMessage('User saved.');
            
            return $this->_redirect('/');
        }
        
        $this->view->register_form = $form;
    }

    public function loginAction()
    {
        
        $form = new Application_Form_UserTopLogin;
        
        $request = $this->getRequest();
        if ($request->isPost() && $form->isValid($request->getPost())) {

                if (false === $this->_authService->authenticate($_POST)) {
                    echo '登录失败';
                }

                $this->_redirect('/');

                return;

        }
    }

    public function logoutAction()
    {
        $this->_authService->clear();
        return $this->_redirect('/');
    }


}









