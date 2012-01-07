<?php

/**
 * Application_Model_User
 *
 * @uses OOXX_Model_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Model_User extends OOXX_Model_Abstract
{
    /**
     * Useer repository
     *
     * @var \OOXX\Entity\Repository\UserRepository
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
        $this->_repository = $this->_entityManager->getRepository('\OOXX\Entity\User');
    }
    
    /**
     * Save the user
     *
     * @param OOXX\Entity\User $user
     * @param array $values
     * @access public
     * @return void
     */
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

