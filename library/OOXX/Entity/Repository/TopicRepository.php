<?php

namespace OOXX\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TopicRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TopicRepository extends EntityRepository
{
    
    public function saveTopic(\OOXX\Entity\Topic $topic, array $values)
    {
        $topic->setTtitle($values['title']);
        $topic->setContent($values['content']);
        $topic->setCreated(new \DateTime("now"));

        $this->getEntityManager()->persist($topic);
    }
}