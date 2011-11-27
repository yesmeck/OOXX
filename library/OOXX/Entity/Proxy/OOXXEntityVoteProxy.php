<?php

namespace OOXX\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class OOXXEntityVoteProxy extends \OOXX\Entity\Vote implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    private function _load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    
    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function setType($type)
    {
        $this->_load();
        return parent::setType($type);
    }

    public function getType()
    {
        $this->_load();
        return parent::getType();
    }

    public function setQuestion(\OOXX\Entity\Question $question)
    {
        $this->_load();
        return parent::setQuestion($question);
    }

    public function getQuestion()
    {
        $this->_load();
        return parent::getQuestion();
    }

    public function setUser(\OOXX\Entity\User $user)
    {
        $this->_load();
        return parent::setUser($user);
    }

    public function getUser()
    {
        $this->_load();
        return parent::getUser();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'type', 'question', 'user');
    }
}