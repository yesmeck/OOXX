<?php

/**
 * OOXX_Model_Abstract
 *
 * @uses OOXX_Model_Interface
 * @implements OOXX_Model_Interface
 * @abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

abstract class OOXX_Model_Abstract implements OOXX_Model_Interface
{
    /**
     * Doctrine
     *
     * @var mixed
     * @access protected
     */
    protected $_doctrine;

    /**
     * EntityManager
     *
     * @var mixed
     * @var Doctrine\ORM\EntityManager
     * @access protected
     */
    protected $_entityManager;
    
    /**
     * Repository
     *
     * @var Bisna\Application\Container\DoctrineContainer
     * @access protected
     */
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
    
    /**
     * Call repository's method
     *
     * @param string $name
     * @param mixed $arguments
     * @access public
     * @return void
     */
    public function __call($name, $arguments) {
        if (!method_exists($this, $name)) {
            return call_user_func_array(array($this->_repository, $name), $arguments);
        }
    }
    
}
