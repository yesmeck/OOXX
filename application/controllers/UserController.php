<?php

class UserController extends Zend_Controller_Action
{

    /**
     * @var Bisna\Application\Container\DoctrineContainer
     *
     */
    protected $doctrine = null;

    /**
     * @var Doctrine\ORM\EntityManager
     *
     */
    protected $entityManager = null;

    /**
     * @var OOXX\Entity\Repository\topicRepository
     *
     */
    protected $userRepository = null;

    public function init()
    {
        $this->doctrine = Zend_Registry::get('doctrine');
        $this->entityManager = $this->doctrine->getEntityManager();
        $this->userRepository = $this->entityManager->getRepository('\OOXX\Entity\User');
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

            $this->userRepository->saveUser($user, $_POST);

            $this->entityManager->flush();
    
            $this->_helper->flashMessenger->addMessage('User saved.');
            
            return $this->_redirect('/');
        }
        
        $this->view->form = $form;
    }

}





