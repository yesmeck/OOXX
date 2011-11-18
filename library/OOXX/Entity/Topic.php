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
     */
    public function setTtitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Get title
     * 
     * @return string
     */
    public function getTtitle()
    {
        return $this->title;
    }
    
    /**
     * Set content
     * 
     * @param string $content 
     */
    public function setContent($content)
    {
        $this->content = $content;
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
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
}