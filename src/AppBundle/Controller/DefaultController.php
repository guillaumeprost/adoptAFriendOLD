<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Animal\Dog;
use AppBundle\Form\Animal\AnimalType;
use AppBundle\Form\Animal\DogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
          $dog = new Dog();
          $form = $this->createForm(DogType::class, $dog);
          $form->add('submit', SubmitType::class, [
                'label' => 'Create',
                'attr'  => [
                      'class' => 'btn btn-default'
                ]
          ]);

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
                $this->getEntityManager()->persist($dog);
                $this->getEntityManager()->flush($dog);
          }
        
          // replace this example code with whatever you need
          return $this->render('default/index.html.twig', [
              'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
              'form'   => $form->createView()
          ]);
    }
}
