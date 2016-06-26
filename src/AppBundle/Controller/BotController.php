<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 26/06/2016
 * Time: 12:23
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class BotController extends BaseController
{
    /**
     * @Route("/bot", name="bot", )
     * @Method({"POST"})
     */
    public function botAction(Request $request)
    {
        //$botResponse = $this->get('app.bot')->manageDemand($request->request->get('demand'));
        if ($request->request->get('demand')) {
            $lowerDemand = mb_strtolower($request->request->get('demand'),'UTF-8');
            if (strstr($lowerDemand, 'créer')) {
                return $this->redirectToRoute('offer_create');
            } elseif (strstr($lowerDemand, 'chien')) {
                return $this->redirectToRoute('search_offer');
            } else {
                die('pas trouvé');
            }
        } else {
            throw new Exception('invalid parameter');
        }
    }
}