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
        $topic->setTtitle($values['title']);
        $topic->setContent($values['content']);
        $topic->setCreated(new \DateTime("now"));

        $this->_entityManager->persist($topic);
        $this->_entityManager->flush();
    }
  
}

?>
