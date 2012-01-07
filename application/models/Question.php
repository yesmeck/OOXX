<?php

/**
 * Application_Model_Question
 *
 * @uses OOXX_Model_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_Question extends OOXX_Model_Abstract
{
    /**
     * Question repository
     *
     * @var \OOXX\Entity\Repository\QuestionRepository
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
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Question');
    }
    
    /**
     * Save the question
     *
     * @param array $values
     * @access public
     * @return void
     */
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
    
    
    /**
     * Get answered questions
     *
     * @param \OOXX\Entity\Topic $topic
     * @access public
     * @return array
     */
    public function getAnsweredQuestions(\OOXX\Entity\Topic $topic)
    {
        return $this->findBy(array(
            'status' => 'close',
            'topic'  => $topic->getId(),
        ));
    }


    /**
     * Get unanswered questions
     *
     * @param \OOXX\Entity\Topic $topic
     * @access public
     * @return array
     */
    public function getUnansweredQuestions(\OOXX\Entity\Topic $topic)
    {
        return $this->findBy(array(
            'status' => 'open',
            'topic'  => $topic->getId(),
        ));
    }
}

