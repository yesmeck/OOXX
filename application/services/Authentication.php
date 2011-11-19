<?php

class Application_Service_Authentication 
{
    /**
     * @var Zend_Auth_Adapter_DbTable
     */
    protected $_authAdapter;

    /**
     * @var Zend_Auth
     */
    protected $_auth;
    
    /**
     * @var Bisna\Application\Container\DoctrineContainer
     *
     *
     */
    protected $doctrine = null;

    /**
     * @var Doctrine\ORM\EntityManager
     *
     *
     */
    protected $entityManager = null;

    /**
     * @var OOXX\Entity\Repository\topicRepository
     *
     *
     */
    protected $userRepository = null;

    /**
     * Construct 
     * 
     * @param null|Storefront_Model_User $userModel 
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

        if (!$result->isValid()) {
            return false;
        }

        $user = $this->userRepository->findOneBy(array('email' => $credentials['email']));

        $auth->getStorage()->write($user);
        
        return true;
    }

    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }

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
     */
    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }
    
    /**
     * Set the auth adpater.
     *
     * @param Zend_Auth_Adapter_Interface $adapter
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
            $authAdapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table_Abstract::getDefaultAdapter(),
                'user',
                'email',
                'password'
            );
            $this->setAuthAdapter($authAdapter);
            $this->_authAdapter->setIdentity($values['email']);
            $this->_authAdapter->setCredential($values['password']);
        }
        return $this->_authAdapter;
    }
}
