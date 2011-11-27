<?php

abstract class OOXX_Model_Abstract implements OOXX_Model_Interface
{
    protected $_doctrine;

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $_entityManager;
    
    protected $_repository;
    
    public function __construct()
    {
        $this->_doctrine = Zend_Registry::get('doctrine');
        $this->_entityManager = $this->_doctrine->getEntityManager();
        $this->init();
    }
    
    public function init()
    {
        return;
    }
    
    public function __call($name, $arguments) {
        if (!method_exists($this, $name)) {
            return call_user_func_array(array($this->_repository, $name), $arguments);
        }
    }
    
}
