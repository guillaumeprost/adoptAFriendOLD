<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 * @package AppBundle\Controller
 *
 * Must be extends by all controllers
 */
abstract class BaseController extends Controller
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|EntityManager|object
     */
    protected function getEntityManager()
    {
        if (! $this->entityManager instanceof EntityManager) {
            $this->entityManager = $this->getDoctrine()->getManager();
        }
        return $this->entityManager;
    }

    /**
     * @param $className
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    protected function getRepository($className){
        return $this->getEntityManager()->getRepository($className);
    }
}
