<?php

use OOXX\Entity\Question;
use OOXX\Entity\Vote;
use OOXX\Entity\User;

class Application_Model_Vote extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Vote');
    }
    
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
     * @param \OOXX\Entity\Question $question
     * @return null|\OOXX\Entity\Vote
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