<?php

use OOXX\Entity\Answer;

class Application_Model_Answer extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Answer');
    }
    
    public function save(array $values, \OOXX\Entity\Question $question)
    {
        $answer = new Answer;
        
        $answer->setContent($values['content'])
               ->setCreated(new DateTime('now'))
               ->setQuestion($question);
        
        $this->_entityManager->persist($answer);
        
        $question->close();
        
        $this->_entityManager->persist($question);
        
        $this->_entityManager->flush();
    }
}