<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('drivingLicence', ChoiceType::class, [
                'expanded'=> true,
                'multiple' => false,
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],

                //attribution d'une class à chaque radio
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'form-check-input'];
                },
            ])
            ->add('address')
            ->add('postcode')
            ->add('city')
            ->add('phoneNumber', TelType::class)
            ->add('mail', EmailType::class)
            ->add('description', TextareaType::class)
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
