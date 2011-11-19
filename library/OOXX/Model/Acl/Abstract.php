<?php

abstract class OOXX_Model_Acl_Abstract extends OOXX_Model_Abstract
    implements OOXX_Model_Acl_Interface, Zend_Acl_Resource_Interface
{
    protected $_acl;
    
    protected $_identity;

    public function setIdentity($identity)
    {
        if (is_object($identity)) {
            
            if (null == $identity->getRoleId()) {
                $identity->setRoleId('Guest');
            }
            $identity = new Zend_Acl_Role($identity->getRoleId());
            
        } elseif (is_scalar($identity) && !is_bool($identity)) {
            
            $identity = new Zend_Acl_Role($identity);
            
        } elseif (!$identity instanceof Zend_Acl_Role_Interface) {
            
            throw new OOXX_Model_Exception('Invalid identity provided');
            
        }
        
        $this->_identity = $identity;
        
        return $this;
    }
    
    public function getIdentity()
    {
        if (null === $this->_identity) {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                return 'Guest';
            }
            $this->setIdentity($auth->getIdentity());
        }
        return $this->_identity;
    }
    
    public function checkAcl($action)
    {
        return $this->getAcl()->isAllowed(
            $this->getIdentity(),
            $this,
            $action
       );
    }

}
?>
