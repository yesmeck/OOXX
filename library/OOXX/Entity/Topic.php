<?php

namespace OOXX\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\TopicRepository") @Table(name="topic")
 */
class Topic
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var integer
     */
    protected $id;
    
    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $title;
    
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
     * @ManyToOne(targetEntity="User", inversedBy="topics")
     * @var \OOXX\Entity\User
     */
    protected $user;

    /**
     * @OneToMany(targetEntity="Question", mappedBy="topic")
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $questions;
    
    /**
     * Construct
     */
    public function __construct()
    {
        $this->questions = new ArrayCollection;
    }

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
     * Set title
     * 
     * @param string $title 
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * Get title
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set content
     * 
     * @param string $content 
     * @return Topic
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * Get content
     * 
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set created time
     * 
     * @param string $created 
     * @return Topic
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }


    /**
     * Get created time
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
     * @return Topic
     */
    public function setUser(\OOXX\Entity\User $user)
    {
        $user->addTopic($this);
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
     * Add question
     * 
     * @param \OOXX\Entity\Question $question
     * @return Topic 
     */
    public function addQuestion(\OOXX\Entity\Question $question)
    {
        $this->questions[] = $question;
        return $this;
    }
    
    /**
     * Get questions
     * 
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    
    /**
     * Check topic whether belong to the user.
     * 
     * @param null|\OOXX\Entity\User $user
     * @return bool
     */
    public function isBelongTo($user)
    {
        if (null === $user) {
            return false;
        }
        return $this->getUser()->getId() === $user->getId();
    }
}