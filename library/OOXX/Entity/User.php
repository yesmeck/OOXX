<?php

namespace OOXX\Entity;

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
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
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
    
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }
    
    public function getRoleId()
    {
        return $this->roleId;
    }

        /**
     * Set lasLogin time
     * 
     * @param string $lastLogin 
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
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