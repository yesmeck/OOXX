<?php

namespace OOXX\Entity;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\VoteRepository") @Table(name="vote")
 */
class Vote
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Question", inversedBy="votes")
     * @var \OOXX\Entity\Question
     */
    protected $question;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="votes")
     * @var \OOXX\Entity\User
     */
    protected $user;
    
    /**
     * Get id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set question
     * 
     * @param \OOXX\Entity\Question $question
     * @return Vote 
     */
    public function setQuestion(\OOXX\Entity\Question $question)
    {
        $question->addVote($this);
        
        $this->question = $question;
        
        return $this;
    }
    
    /**
     * Get question
     * 
     * @return \OOXX\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
    
    /**
     * Set user
     * 
     * @param \OOXX\Entity\User $user
     * @return Vote 
     */
    public function setUser(\OOXX\Entity\User $user)
    {
        $user->addVote($this);
        
        $this->user = $user;
        
        return $this;
    }
    
    /**
     * Get user
     * 
     * @return \OOXX\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}