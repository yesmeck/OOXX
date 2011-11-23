<?php

namespace OOXX\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="OOXX\Entity\Repository\UserRepository") @Table(name="user")
 */
class User
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $email;
    
    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $password;
    
    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $nickname;
    
    /**
     * @Column(type="string", length=50)
     * @var string
     */
    protected $roleId;

    /**
     * @Column(type="datetime", nullable=true)
     * @var string
     */
    protected $lastLogin;

    /**
     * @Column(type="datetime")
     * @var string
     */
    protected $created;
    
    /**
     * @OneToMany(targetEntity="Topic", mappedBy="user")
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $topics = null;
    
    /**
     * @OneToMany(targetEntity="Question", mappedBy="user");
     * @var Doctrine\Common\Collections\ArrayCollection 
     */
    protected $questions = null;
    

    public function __construct()
    {
        $this->topics = new ArrayCollection;
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
     * Set email
     * 
     * @param string $email 
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * Get email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set password
     * 
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    /**
     * Get password
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set nickname
     * 
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }
    
    /**
     * Get nickname
     * 
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    
    /**
     * Set roleId
     * 
     * @param string $roleId
     * @return User 
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        return $this;
    }
    
    /**
     * Get roleId
     * 
     * @return string
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set lasLogin time
     * 
     * @param string $lastLogin 
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
    
    /**
     * Get lastLogin time
     * 
     * @return string
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
    
    /**
     * Set created time
     * 
     * @param type $created 
     * @return User
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
     * Add toplic
     * 
     * @param \OOXX\Entity\Topic $topic
     * @return User 
     */
    public function addTopic(\OOXX\Entity\Topic $topic)
    {
        $this->topics[] = $topic;
        return $this;
    }
    
    /**
     * Add question
     * 
     * @param \OOXX\Entity\Question $question
     * @return User
     */
    public function addQuestion(\OOXX\Entity\Question $question)
    {
        $this->questions[] = $question;
        return $this;
    }
}