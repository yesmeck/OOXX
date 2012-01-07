<?php

/**
 * Application_Service_Authentication
 *
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Service_Authentication 
{
    /**
     * _authAdapter
     *
     * @var Zend_Auth_Adapter_DbTable
     * @access protected
     */
    protected $_authAdapter;

    /**
     * _auth
     *
     * @var Zend_Auth
     * @access protected
     */
    protected $_auth;
    
    /**
     * doctrine
     *
     * @var Bisna\Application\Container\DoctrineContainer
     * @access protected
     */
    protected $doctrine = null;

    /**
     * entityManager
     *
     * @var Doctrine\ORM\EntityManager
     * @access protected
     */
    protected $entityManager = null;

    /**
     * userRepository
     *
     * @var OOXX\Entity\Repository\topicRepository
     * @access protected
     */
    protected $userRepository = null;

    /**
     * __construct
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->doctrine = Zend_Registry::get('doctrine');
        $this->entityManager = $this->doctrine->getEntityManager();
        $this->userRepository = $this->entityManager->getRepository('\OOXX\Entity\User');
    }

    /**
     * Authenticate a user
     *
     * @param  array $credentials Matched pair array containing email/passwd
     * @return boolean
     */
    public function authenticate($credentials)
    {
        $adapter = $this->getAuthAdapter($credentials);
        $auth    = $this->getAuth();
        $result  = $auth->authenticate($adapter);

        if ($result->isValid()) {
            $auth->getStorage()->write($adapter->getResultRow());
        }

        return $result;
    }

    /**
     * getAuth
     *
     * @access public
     * @return Zend_Auth
     */
    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }

    /**
     * getIdentity
     *
     * @access public
     * @return mix
     */
    public function getIdentity()
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity()) {
            return $auth->getIdentity();
        }
        return false;
    }
    
    /**
     * Clear any authentication data
     *
     * @access public
     * @return void
     */
    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }
    
    /**
     * Set the auth adpater.
     *
     * @param Zend_Auth_Adapter_Interface $adapter
     * @access public
     * @return void
     */
    public function setAuthAdapter(Zend_Auth_Adapter_Interface $adapter)
    {
        $this->_authAdapter = $adapter;
    }
    
    /**
     * Get and configure the auth adapter
     * 
     * @param  array $value Array of user credentials
     * @return Zend_Auth_Adapter_DbTable
     */
    public function getAuthAdapter($values)
    {
        if (null === $this->_authAdapter) {
            $authAdapter = new OOXX_Auth_Adapter_Doctrine(
                new Application_Model_User,
                'email',
                'password',
                array(
                    new Application_Service_Password,
                    'check',
                )
            );
            $this->setAuthAdapter($authAdapter);
            $this->_authAdapter->setIdentity($values['email'])
                               ->setCredential($values['password']);
        }
        return $this->_authAdapter;
    }
}

