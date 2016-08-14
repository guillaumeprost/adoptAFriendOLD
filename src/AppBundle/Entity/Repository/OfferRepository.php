<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 07/05/2016
 * Time: 11:47
 */

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Offer;
use AppBundle\Form\Model\Search\OfferModel;
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

    /**
     * @return mixed
     */
    public function findNewestActive()
    {
        $qb = $this->createQueryBuilder('o');
        $qb->where('o.status = :status');
        $qb->setParameter('status', Offer::STATUS_ACTIVE);
        $qb->orderBy('o.created');

        $qb->setMaxResults(6);

        return $qb->getQuery()->execute();
    }

    /**
     * @return mixed
     */
    public function findMostViewedActive()
    {
        $qb = $this->createQueryBuilder('o');
        $qb->where('o.status = :status');
        $qb->setParameter('status', Offer::STATUS_ACTIVE);
        $qb->orderBy('o.views', 'DESC');

        $qb->setMaxResults(6);
        return $qb->getQuery()->execute();
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findBySearch($filters = [])
    {
        $qb = $this->createQueryBuilder('o');
        $qb->where('o.status = :status');
        $qb->setParameter('status', Offer::STATUS_ACTIVE);

        if (isset($filters['title'])) {
            $qb->andWhere($qb->expr()->like('o.title', ':title'));
            $qb->setParameter(':title', $filters['title']);
        }

        $qb->orderBy('o.created');

        return $qb->getQuery()->execute();
    }

    /**
     * @param OfferModel $model
     * @return Offer[]
     */
    public function findBySearchModel(OfferModel $model)
    {
        $qb = $this->createQueryBuilder('o');

        if (null !== $model->getTitle()) {
            $qb->andWhere($qb->expr()->like('LOWER(o.title)',':title'))
                ->setParameter('title', '%'.$model->getTitle().'%');
        }

        return $qb->getQuery()->getResult();
    }
}
