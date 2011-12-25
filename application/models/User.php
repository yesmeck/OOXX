<?php

class Application_Model_User extends OOXX_Model_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\User');
    }
    
    public function save(OOXX\Entity\User $user, array $values) {
        
        $user->setEmail($values['email']);
        $user->setNickname($values['nickname']);

        if (null == $user->getId()) {
            $user->setRoleId('User');
            $user->setCreated(new \DateTime('now'));
        } else {
            $user->setIntroduction($values['introduction']);
        }

        if (isset($values['password']) && '' != $values['password']) {
            $passwordService = new Application_Service_Password;
            $values['password'] = $passwordService->hash($values['password']);
            $user->setPassword($values['password']);
        }
        
        $this->_entityManager->persist($user);
        $this->_entityManager->flush();
    }

}
