<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', ChoiceType::class, [
                'choices' => Contact::TITRE
            ])
            ->add('demande', ChoiceType::class, [
                'choices' => Contact::DEMAMDE
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr'=>[
                    'placeholder' => 'Prénom *'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr'=>[
                    'placeholder' => 'Nom *'
                ]
            ])
            ->add('mail', TextType::class, [
                'label' => 'Votre E-mail',
                'attr'=>[
                    'placeholder' => 'Email *'
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Votre numéro de téléphone',
                'attr'=>[
                    'placeholder' => 'Votre numéro de téléphone *'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre numéro de téléphone',
                'attr'=>[
                    'rows' => 8,
                    'placeholder' => 'Bonjour,

Je souhaite réserver le véhicule suivant : '
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
