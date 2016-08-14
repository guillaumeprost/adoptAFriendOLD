<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 18:05
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Offer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package AppBundle\Controller
 */
class HomeController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $newestOffer = $this->getRepository('AppBundle:Offer')->findNewestActive();

        $mostViewedOffers = $this->getRepository('AppBundle:Offer')->findMostViewedActive();

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'newestOffers'     => $newestOffer,
            'mostViewedOffers' => $mostViewedOffers
        ]);
    }
}
