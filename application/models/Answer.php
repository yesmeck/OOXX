<?php

/**
 * Application_Model_Answer
 *
 * @uses OOXX_Model_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

use OOXX\Entity\Answer;

class Application_Model_Answer extends OOXX_Model_Abstract
{
    /**
     * Answer repository
     *
     * @var \OOXX\Entity\Repository\AnswerRepository
     * @access protected
     */
    protected $_repository;
    
    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Answer');
    }
    
    /**
     * Save the answer
     *
     * @param array $values
     * @param \OOXX\Entity\Question $question
     * @access public
     * @return void
     */
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

