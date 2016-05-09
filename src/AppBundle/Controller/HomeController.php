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
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
      /**
       * @Route("/", name="homepage")
       */
      public function indexAction(Request $request)
      {
            // replace this example code with whatever you need
            return $this->render('home/index.html.twig', [
            ]);
      }
}
