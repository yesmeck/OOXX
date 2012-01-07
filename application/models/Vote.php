<?php

/**
 * Application_Model_Vote
 *
 * @uses OOXX_Model_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

use OOXX\Entity\Question;
use OOXX\Entity\Vote;
use OOXX\Entity\User;

class Application_Model_Vote extends OOXX_Model_Abstract
{
    /**
     * Votew repository
     *
     * @var \OOXX\Entity\Repository\VoteRepository
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
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Vote');
    }
    
    /**
     * Add a vote
     *
     * @param Question $question
     * @param User $user
     * @param string $type
     * @access public
     * @return void
     */
    public function add(Question $question, User $user, $type)
    {
        
        $maybeVoted = $this->getVoteToQuestionByUser($question, $user);
        
        if (isset ($maybeVoted)) {
            $this->delete($maybeVoted);
        }
        
        $vote = new Vote;
        
        $vote->setType($type)
             ->setQuestion($question)
             ->setUser($user);
        
        $this->_entityManager->persist($vote);

        $this->_entityManager->flush();
    }
    
    /**
     * Delete a vote
     *
     * @param Vote $vote
     * @access public
     * @return void
     */
    public function delete(Vote $vote)
    {
        $this->_entityManager->remove($vote);
        
        $question = $vote->getQuestion();
        
        switch ($vote->getType()) {
           case Vote::TYPE_UP:
               $question->subtractVoteCount();
               break;

           case Vote::TYPE_DOWN:
               $question->addVoteCount();
               break;
       }
        
        $this->_entityManager->persist($question);
        
        $this->_entityManager->flush();
    }
    
    /**
     * Get vote to question by user
     *
     * @param Question $question
     * @param User $user
     * @param bool $type
     * @access public
     * @return void
     */
    public function getVoteToQuestionByUser(Question $question, User $user, $type = null)
    {
        $criteria = array(
            'question'  => $question->getId(),
            'user'      => $user->getId(),
        );
        
        if (isset ($type)) {
            $criteria['type'] = $type;
        }
        
        return $this->findOneBy($criteria);
    }
}

