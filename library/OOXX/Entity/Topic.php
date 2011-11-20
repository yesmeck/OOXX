<?php

namespace OOXX\Entity;

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
}