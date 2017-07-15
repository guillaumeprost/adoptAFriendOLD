<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 20:01
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Animal\Dog;
use AppBundle\Entity\Offer;
use AppBundle\Form\Type\Animal\DogType;
use AppBundle\Form\Type\OfferType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Form;
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
     * @param Offer $offer
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/show/{slug}", name="offer_show")
     */
    public function showAction(Offer $offer)
    {
        $offer->incrementViews();
        $this->getEntityManager()->flush($offer);
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
//        $offer = new Offer();
//        $offerForm = $this->createForm(OfferType::class, $offer);
//
//        $offerForm->handleRequest($request);
//        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
//            $offer->setSlug($offer->getTitle());
//            $offer->setCreated(new \DateTime());
//            $offer->setUpdated(new \DateTime());
//
//            $this->getEntityManager()->persist($offer);
//            $this->getEntityManager()->flush($offer);
//
//            return $this->redirectToRoute('offer_show', ['slug' => $offer->getSlug()]);
//        }

        return $this->render(':offer:create.html.twig', [
        ]);
    }

    /**
     * @Route("/render-form/{type}", name="offer_render_form")
     *
     * @param Request $request
     * @param $type
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function renderFormAction(Request $request, $type)
    {
        $offer = new Offer();
        $offerForm = $this->createForm(OfferType::class, $offer);
        $this->manageAnimalType($offerForm, $type);
        $offerForm->handleRequest($request);

        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offer->setSlug($offer->getTitle());
            $offer->setCreated(new \DateTime());
            $offer->setUpdated(new \DateTime());

            $this->getEntityManager()->persist($offer);
            $this->getEntityManager()->flush($offer);

            return $this->redirectToRoute('offer_show', ['slug' => $offer->getSlug()]);
        }

        return $this->render(':offer:create.html.twig', [
            'form' => $offerForm->createView()
        ]);
    }

    /**
     * @param Form $form
     * @param $type
     * @return Form
     */
    public function manageAnimalType(Form $form, $type)
    {
        switch ($type){
            case $type == Dog::DISCIMINATOR :
                $form->add('animals', CollectionType::class, [
                    'entry_type' => DogType::class,
                    'allow_add' => true,
                    'prototype' => true,
                ]);
                break;
        }

        return $form;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addAnimalType(Request $request)
    {
        try {
            switch ($request->request->get('animalType')) {
                case Offer::ANIMAL_TYPE_DOG:
                    $this->offerForm->add('tags', CollectionType::class, [
                        'entry_type' => DogType::class
                    ]);
                    return new JsonResponse([
                        'success' => true,
                        'message' => 'Dog type added'
                    ]);
                    break;
                default:
                    return new JsonResponse([
                        'success' => false,
                        'message' => 'Wrong animal type provided'
                    ]);
                    break;
            }
        } catch (Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
