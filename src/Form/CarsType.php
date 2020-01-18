<?php

namespace App\Form;

use App\Entity\Boites;
use App\Entity\Carburations;
use App\Entity\Cars;
use App\Entity\Couleurs;
use App\Entity\Etats;
use App\Entity\Marques;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model')
            ->add('chevaux')
            ->add('version')
            ->add('puissance')
            ->add('co2')
            ->add('porte')
            ->add('prix')
            ->add('annee')
            ->add('kilometre')
            ->add('boites', EntityType::class, [
                'class' => Boites::class,
                'choice_label' => 'boite'
            ])
            ->add('carburations', EntityType::class, [
                'class'=> Carburations::class,
                'choice_label' => 'carburation'
            ])
            ->add('couleurs', EntityType::class, [
                'class'=> Couleurs::class,
                'choice_label' => 'couleur'
            ])
            ->add('etats', EntityType::class, [
                'class'=> Etats::class,
                'choice_label' => 'etat'
            ])
            ->add('marques', EntityType::class, [
                'class'=> Marques::class,
                'choice_label' => 'marque'
            ])
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImagesType::class,
                    'allow_add' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
