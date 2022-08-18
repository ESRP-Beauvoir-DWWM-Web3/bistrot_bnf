<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tables;
use App\Entity\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class, [
                'widget' => 'choice'
            ])
            ->add('nom', EntityType::class, [
                'class' => User::class,
                'choice_label'=> 'Nom',
                'label' => 'Sélectionner le nom du client :',
                'attr' => [
                    'class' => 'form-select'
                ]

            ])
            ->add('tables', EntityType::class, [
                'class' => Tables::class,
                'choice_label'=> 'id',
                'label' => 'Sélectionner table :',
                'attr' => [
                    'class' => 'form-select'
                ],
                'multiple' => true,
                'expanded' => true,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
