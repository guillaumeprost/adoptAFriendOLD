<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 07/05/2016
 * Time: 11:47
 */

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Offer;
use Doctrine\ORM\EntityRepository;

/**
 * Class OfferRepository
 * @package AppBundle\Entity\Repository
 */
class OfferRepository extends EntityRepository
{
      /**
       * @param array $filter
       * @return mixed
       */
      public function findFilteredActive($filter = [])
      {
            $qb = $this->createQueryBuilder('o');
            $qb->where('o.status = :status');
            $qb->setParameter('status', Offer::STATUS_ACTIVE);

            if (isset($filter['title'])) {
                  $qb->where('o.title like *:title*');
                  $qb->setParameter('title', $filter['title']);
            }

            if (isset($filter['departement'])) {
                  $qb->where('o.departement like *:departement*');
                  $qb->setParameter('departement', $filter['departement']);
            }

            $qb->orderBy('o.created');

            return $qb->getQuery()->execute();
      }
}
