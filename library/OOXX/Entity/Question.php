<?php

namespace OOXX\Entity;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\QuestionRepository")
 * @Table(name="question")
 */
class Question
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="text")
     * @var string
     */
    protected $content;
    
    /**
     * @Column(type="datetime")
     * @var string
     */
    protected $created;

    /**
     * @ManyToOne(targetEntity="Topic", inversedBy="questions")
     * @var int
     */
    protected $topic;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="questions")
     * @var int
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
     * Set content
     * 
     * @param string $content
     * @return Question 
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * Get content
     * 
     * @return stirng
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set created
     * 
     * @param \DateTime $created
     * @return Question 
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        return $this;
    }
    
    /**
     * Get created
     * 
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * Set user
     * 
     * @param \OOXX\Entity\User $user
     * @return Question 
     */
    public function setUser(\OOXX\Entity\User $user)
    {
        $user->addQuestion($this);
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

    /**
     * Set topic
     * 
     * @param \OOXX\Entity\Topic $topic
     * @return Question 
     */
    public function setTopic(\OOXX\Entity\Topic $topic)
    {
        $topic->addQuestion($this);
        $this->topic = $topic;
        return $this;
    }
    
    /**
     * Get topic
     * 
     * @return \OOXX\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}