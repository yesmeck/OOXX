<?php

namespace OOXX\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function saveUser(\OOXX\Entity\User $user, $values) {
        
        $user->setEmail($values['email']);
        $user->setPassword($values['password']);
        $user->setNickname($values['nickname']);
        $user->setCreated(new \DateTime('now'));
        
        $this->getEntityManager()->persist($user);
    }
}