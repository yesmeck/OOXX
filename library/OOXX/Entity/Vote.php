<?php

namespace OOXX\Entity;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\VoteRepository") @Table(name="vote")
 */
class Vote
{
    
    const TYPE_UP = 'up';
    const TYPE_DOWN = 'down';

    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", length="10");
     * @var string
     */
    protected $type;


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
     * Set type
     * 
     * @param string $type
     * @return Vote
     */
    public function setType($type)
    {
        if (!in_array($type, array(self::TYPE_UP, self::TYPE_DOWN))) {
            throw new \InvalidArgumentException('Invalid type');
        }
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * Get type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
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