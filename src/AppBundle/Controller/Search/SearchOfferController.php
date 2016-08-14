<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 18:21
 */

namespace AppBundle\Controller\Search;

use AppBundle\Controller\BaseController;
use AppBundle\Form\Model\Search\OfferModel;
use AppBundle\Form\Type\Search\OfferType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchOfferController
 * @package AppBundle\Controller\Search
 *
 * @Route("/recherche-offre")
 */
class SearchOfferController extends BaseController
{
    /**
     * Search an offer
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="search_offer")
     */
    public function indexAction(Request $request)
    {
        $searchOfferModel = new OfferModel();
        $offers = [];

        /** @var OfferType $form */
        $form = $this->createForm(OfferType::class, $searchOfferModel);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $offers = $this->getEntityManager()->getRepository('AppBundle:Offer')->findBySearchModel($searchOfferModel);
        }

        return $this->render('search/searchOffer/index.html.twig', [
            'form'   => $form->createView(),
            'offers' => $offers
        ]);
    }
}
