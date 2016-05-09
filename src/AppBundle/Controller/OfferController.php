<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 20:01
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Animal\Animal;
use AppBundle\Entity\Offer;
use AppBundle\Form\Animal\DogType;
use AppBundle\Form\OfferType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class OfferController
 * @package AppBundle\Controller
 *
 * @Route("/offre")
 */
class OfferController extends BaseController
{
      /**
       * @var OfferType
       */
      private $offerForm;

      /**
       * @param Offer $offer
       * @return \Symfony\Component\HttpFoundation\Response
       *
       * @Route("/show/{slug}", name="offer_show")
       */
      public function showAction(Offer $offer)
      {
            return $this->render(':offer:show.html.twig', [
                  'offer' => $offer
            ]);
      }

      /**
       * @param Request $request
       * @return \Symfony\Component\HttpFoundation\Response
       *
       * @Route("/creer", name="offer_create")
       */
      public function createAction(Request $request)
      {
            $offer = new Offer();
            $this->offerForm = $this->createForm(OfferType::class, $offer);

            $this->offerForm->handleRequest($request);

            if ($this->offerForm->isSubmitted() && $this->offerForm->isValid()) {
                  $offer->setSlug($offer->getTitle());
                  $offer->setCreated(new \DateTime());

                  $this->getEntityManager()->persist($offer);
                  $this->getEntityManager()->flush($offer);
            }
            
            return $this->render(':offer:create.html.twig', [
                  'form' => $this->offerForm->createView()
            ]);
      }

      /**
       * @param Request $request
       * @return JsonResponse
       */
      public function addAnimalType(Request $request)
      {
            try {
                  switch ($request->request->get('animalType'))
                  {
                        case Offer::ANIMAL_TYPE_DOG:
                              $this->offerForm->add('tags', CollectionType::class, [
                                    'entry_type' => DogType::class
                              ]);
                              break;

                              return new JsonResponse([
                                    'success' => true,
                                    'message' => 'Dog type added'
                              ]);
                        default:
                              return new JsonResponse([
                                    'success' => false,
                                    'message' => 'Wrong animal type provided'
                              ]);
                  }
            } catch(Exception $e) {
                  return new JsonResponse([
                        'success' => false,
                        'message' => $e->getMessage()
                  ]);
            }
      }
}
