<?php

class TopicController extends Zend_Controller_Action
{
    /**
     * @var Bisna\Application\Container\DoctrineContainer
     */
    protected $doctrine;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var OOXX\Entity\Repository\topicRepository
     */
    protected $topicRepository;

    public function init()
    {
        $this->doctrine = Zend_Registry::get('doctrine');
        $this->entityManager = $this->doctrine->getEntityManager();
        $this->topicRepository = $this->entityManager->getRepository('\OOXX\Entity\Topic');
    }

    public function indexAction()
    {
        // action body
    }

    public function newAction()
    {
        $form = new Application_Form_Topic();
        
        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            
            $topic = new \OOXX\Entity\Topic;

            $this->topicRepository->saveTopic($topic, $_POST);

            $this->entityManager->flush();
    
            $this->_helper->flashMessenger->addMessage('Topic saved.');
            
            return $this->_redirect('/topic/new');
        }
        
        $this->view->form = $form;
    }


}



