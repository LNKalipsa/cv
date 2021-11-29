<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('school')
            ->add('localisation')
            ->add('startDate', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('endDate', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('diploma')
            ->add('competences', EntityType::class, [
                'class'=> Competence::class,
                'expanded' => false,
                'multiple' => true
            ])
            ->add('description', TextareaType::class)
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
