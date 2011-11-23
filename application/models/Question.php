<?php

class Application_Model_Question extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Question');
    }
    
    public function save($values)
    {
        $question = new \OOXX\Entity\Question;
        
        $userModel = new Application_Model_User;
        $user = $userModel->find(Zend_Registry::get('authUser')->getId());
        
        $topicModel = new Application_Model_Topic;
        $topic = $topicModel->find($values['topicId']);
        
        $question->setContent($values['content'])
                 ->setCreated(new \DateTime('now'))
                 ->setUser($user)
                 ->setTopic($topic);
        
        $this->_entityManager->persist($question);
        $this->_entityManager->flush();
    }
    
    public function getUnanswerQuestions(\OOXX\Entity\Topic $topic)
    {
        return $topic->getQuestions();
    }
}