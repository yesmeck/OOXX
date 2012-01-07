<?php

/**
 * Application_Model_Topic
 *
 * @uses OOXX_Model_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_Topic extends OOXX_Model_Abstract
{
    
    /**
     * Topic repository
     *
     * @var \OOXX\Entity\Repository\TopicRepository
     * @access protected
     */
    protected $_repository;
    
    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\Topic');
    }

    /**
     * Save  the topic
     *
     * @param array $values
     * @access public
     * @return void
     */
    public function save(array $values)
    {
        $topic = new \OOXX\Entity\Topic;
        
        $userModel = new Application_Model_User;
        $user = $userModel->find(Zend_Registry::get('authUser')->getId());
        
        $topic->setTitle($values['title']);
        $topic->setContent($values['content']);
        $topic->setCreated(new \DateTime("now"));
        $topic->setUser($user);

        $this->_entityManager->persist($topic);
        $this->_entityManager->flush();
    }
    
    /**
     * Get recent topics
     *
     * @param int $limit
     * @access public
     * @return array
     */
    public function getRecentTopics($limit = 20)
    {
        $dql = "SELECT t FROM \OOXX\Entity\Topic t";
        $query = $this->_entityManager->createQuery($dql);
        $query->setMaxResults($limit);
        return $query->getResult();
    }
    
    /**
     * Get hot topics
     *
     * @param int $limit
     * @access public
     * @return array
     */
    public function getHotTopics($limit = 20)
    {
        $dql = "SELECT t FROM \OOXX\Entity\Topic t";
        $query = $this->_entityManager->createQuery($dql);
        $query->setMaxResults($limit);
        return $query->getResult();
    }
    
}

