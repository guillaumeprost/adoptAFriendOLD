<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 18:23
 */

namespace AppBundle\Controller\Search;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Animal\Dog;
use AppBundle\Form\Model\Search\AnimalModel;
use AppBundle\Form\Type\Search\AnimalType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchAnimalController
 * @package AppBundle\Controller\Search
 *
 * @Route("/recherche-animal")
 */
class SearchAnimalController extends BaseController
{
      /**
       * Search an Animal
       *
       * @param Request $request
       * @Route("/", name="search_animal")
       */
      public function indexAction(Request $request)
      {
          $searchAnimalModel = new AnimalModel();
          $animals = [];

          /** @var AnimalType $form */
          $form = $this->createForm(AnimalType::class, $searchAnimalModel);

          $form->handleRequest($request);
          if ($form->isValid()) {
            if ($searchAnimalModel->getType() == Dog::DISCIMINATOR) {
                $animals = $this->getEntityManager()->getRepository('AppBundle:Animal\Dog')->findByAnimalModel($searchAnimalModel);
            }
          }

          return $this->render('search/searchAnimal/index.html.twig', [
              'form'    => $form->createView(),
              'animals' => $animals
          ]);
      }
}
