<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 06/05/2016
 * Time: 19:47
 */

namespace AppBundle\Form;

use AppBundle\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
      /**
       * @param FormBuilderInterface $builder
       * @param array $options
       */
      public function buildForm(FormBuilderInterface $builder, array $options)
      {
            parent::buildForm($builder, $options);
            
            $builder
                  ->add('title', TextType::class, [
                        'label'    => 'Titre',
                        'required' => true,
                  ])
                  ->add('description', TextareaType::class)
                  ->add('address1', TextType::class, [
                        'label' => 'Addresse 1'
                  ])
                  ->add('address2', TextType::class, [
                        'label' => 'Addresse 2'
                  ])
                  ->add('postalCode', TextType::class, [
                        'label' => 'Code Postal'
                  ])
                  ->add('city', TextType::class, [
                        'label' => 'Ville'
                  ])
                  ->add('phone', TextType::class, [
                        'label' => 'Téléphone'
                  ])
                  ->add('animalType', ChoiceType::class, [
                        'label'    => 'Quel animal ?',
                        'required' => true,
                        'choices'  => [
                              Offer::ANIMAL_TYPE_DOG => 'Dog'
                        ]
                  ]);
      }

      /**
       * @param OptionsResolver $resolver
       */
      public function configureOptions(OptionsResolver $resolver)
      {
            $resolver->setDefaults([
                  'date_class' => 'AppBundle\Entity\Offer'
            ]);
      }
}
