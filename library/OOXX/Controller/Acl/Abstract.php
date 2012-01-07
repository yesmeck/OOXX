<?php

/**
 * OOXX_Controller_Acl_Abstract
 *
 * @uses Zend_Controller_Action
 * @implements OOXX_Controller_Acl_Interface
 * @implements Zend_Acl_Resource_Interface
 * @abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */
abstract class OOXX_Controller_Acl_Abstract extends Zend_Controller_Action
    implements OOXX_Controller_Acl_Interface, Zend_Acl_Resource_Interface
{
    /**
     * Acl
     *
     * @var Application_Model_Acl
     * @access protected
     */
    protected $_acl;
    
    /**
     * Identity
     *
     * @var mixed
     * @access protected
     */
    protected $_identity;

    /**
     * setIdentity
     *
     * @param mixed $identity
     * @access public
     * @return OOXX_Controller_Acl_Abstract
     */
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
    
    /**
     * Get identity
     *
     * @access public
     * @return mixed
     */
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
    
    /**
     * Get Acl
     *
     * @access public
     * @return Application_Model_Acl
     */
    public function getAcl() {
        if (null === $this->_acl) {
            $this->setAcl(new Application_Model_Acl);
        }
        return $this->_acl;
    }
    
    /**
     * Check Acl
     *
     * @param string $action
     * @access public
     * @return bool
     */
    public function checkAcl($action)
    {
        return $this->getAcl()->isAllowed(
            $this->getIdentity(),
            $this,
            $action
       );
    }
}

