<?php

class Application_Model_User extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\User');
    }
    
    public function save(array $values) {
        
        $user = new \OOXX\Entity\User;
        
        $user->setEmail($values['email']);
        $user->setNickname($values['nickname']);
        $user->setRoleId('User');
        $user->setCreated(new \DateTime('now'));

        if (isset($values['password']) && '' != $values['password']) {
            $passwordService = new Application_Service_Password;
            $values['password'] = $passwordService->hash($values['password']);
            $user->setPassword($values['password']);
        }
        
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();
    }

}
