<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 18:21
 */

namespace AppBundle\Controller\Search;

use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchOfferController
 * @package AppBundle\Controller\Search
 *
 * @Route("/recherche")
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
            $filters = $request->request->all();

            $result = $this->getRepository('AppBundle:Offer')->findFilteredActive($filters);

            return $this->render(':search:index.html.twig', [
                  'result' => $result
            ]);
      }
}
