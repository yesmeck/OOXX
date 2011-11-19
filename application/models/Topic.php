<?php

class Application_Model_Topic extends OOXX_Model_Acl_Abstract
{
    
    protected $_repository;
    
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Topic');
    }
    
    public function getResourceId() {
        return 'Topic';
    }
    
    public function setAcl(OOXX_Acl_Interface $acl) {
        if (!$acl->has($this->getResourceId())) {
            $acl->add($this)
                ->allow('User', $this, array('save'));
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

    public function save(\OOXX\Entity\Topic $topic, array $values)
    {
        
        if (!$this->checkAcl('save')) {
            throw new OOXX_Acl_Exception('Insufficient rights');
        }
        
        $topic->setTtitle($values['title']);
        $topic->setContent($values['content']);
        $topic->setCreated(new \DateTime("now"));

        $this->_entityManager->persist($topic);
        $this->_entityManager->flush();
    }
  
}

?>
