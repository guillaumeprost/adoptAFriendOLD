<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 11:50
 */

namespace AppBundle\Entity\Repository\Animal;

use AppBundle\Form\Model\Search\AnimalModel;
use Doctrine\ORM\EntityRepository;

/**
 * Class DogRepository
 * @package AppBundle\Entity\Repository\Animal
 */
class DogRepository extends EntityRepository
{
    /**
     * @param AnimalModel $model
     * @return Dog[]
     */
    public function findByAnimalModel(AnimalModel $model){
        $qb = $this->createQueryBuilder('d');

        if(null !== $model->getName()) {
            $qb->andWhere($qb->expr()->like('LOWER(d.name)', ':name'));
            $qb->setParameter('name', '%'.strtolower($model->getName()).'%');
        }

        return $qb->getQuery()->getResult();
    }
}