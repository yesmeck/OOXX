<?php

class Application_Model_User extends OOXX_Model_Acl_Abstract
{
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\User');
    }
    
    public function getResourceId() {
        return 'User';
    }
    
    public function setAcl(OOXX_Acl_Interface $acl) {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('Guest', $this, array('save'));
        }
        $this->_acl = $acl;
        return $this;
    }
    
    public function getAcl() {
        if (null === $this->_acl) {
            $this->setAcl(new Application_Model_Acl);
        }
        return $this->_acl;
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
