<?php

class Application_Model_User extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\User');
    }
    
    public function save(\OOXX\Entity\User $user, $values) {
        
        $user->setEmail($values['email']);
        $user->setPassword($values['password']);
        $user->setNickname($values['nickname']);
        $user->setRoleId('User');
        $user->setCreated(new \DateTime('now'));
        
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();
    }
}
