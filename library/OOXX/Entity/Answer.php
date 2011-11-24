<?php

namespace OOXX\Entity;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\AnswerRepository") @Table(name="answer")
 */
class Answer
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
     * @ManyToOne(targetEntity="Question", inversedBy="answer")
     * @var /OOXX/Entity/Question
     */
    protected $question;

    public function getId()
    {
        return $this->id;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
        
        return $this;
    }
    
    public function getCreated()
    {
        return $this->created;
    }
    
    public function setQuestion(\OOXX\Entity\Question $question)
    {
        $question->setAnswer($this);
        $this->question = $question;
        
        return $this;
    }
    
    public function getQuestion()
    {
        return $this->question;
    }
}