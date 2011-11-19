<?php

class UserController extends Zend_Controller_Action
{

    /**
     * @var Bisna\Application\Container\DoctrineContainer
     */
    protected $_doctrine = null;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_entityManager = null;

    /**
     * @var OOXX\Entity\Repository\topicRepository
     */
    protected $_userRepository = null;
    
    /**
     *
     * @var Application_Service_Authentication 
     */
    protected $_authService;

    public function init()
    {
        $this->_doctrine = Zend_Registry::get('doctrine');
        $this->_entityManager = $this->_doctrine->getEntityManager();
        $this->_userRepository = $this->_entityManager->getRepository('\OOXX\Entity\User');
        $this->_authService = new Application_Service_Authentication;
    }

    public function indexAction()
    {
        // action body
    }

    public function registerAction()
    {
        $form = new Application_Form_UserRegister;
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $user = new \OOXX\Entity\User;

            $this->_userRepository->saveUser($user, $_POST);

            $this->_entityManager->flush();
    
            $this->_helper->flashMessenger->addMessage('User saved.');
            
            return $this->_redirect('/');
        }
        
        $this->view->form = $form;
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

    public function topLoginAction()
    {
        $form = new Application_Form_UserTopLogin;
        
        $this->view->form = $form;
        
        $this->_helper->viewRenderer->setResponseSegment($this->_getParam('responseSegment'));
    }

    public function logoutAction()
    {
        $this->_authService->clear();
        return $this->_redirect('/');
    }


}









