<?php

class Application_Model_Topic extends OOXX_Model_Abstract
{
    
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Topic');
    }

    public function save(\OOXX\Entity\Topic $topic, array $values)
    {
        $userModel = new Application_Model_User;
        $user = $userModel->find(Zend_Auth::getInstance()->getIdentity()->getId());
        
        $topic->setTitle($values['title']);
        $topic->setContent($values['content']);
        $topic->setCreated(new \DateTime("now"));
        $topic->setUser($user);

        $this->_entityManager->persist($topic);
        $this->_entityManager->flush();
    }
    
    public function getRecentTopics($limit = 20)
    {
        $dql = "SELECT t FROM \OOXX\Entity\Topic t";
        $query = $this->_entityManager->createQuery($dql);
        $query->setMaxResults($limit);
        return $query->getResult();
    }
    
    public function getHotTopics($limit = 20)
    {
        $dql = "SELECT t FROM \OOXX\Entity\Topic t";
        $query = $this->_entityManager->createQuery($dql);
        $query->setMaxResults($limit);
        return $query->getResult();
    }
    
}

?>
