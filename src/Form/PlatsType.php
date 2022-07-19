<?php

namespace App\Form;

use App\Entity\Plats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du plat :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Choisissez une catégorie :',
                'choices' => [
                    'Entrée' => 'entree',
                    'Plat' => 'plat',
                    'Déssert' => 'dessert',
                ],
                'mapped' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix :',
                'attr' => [
                    'type' => 'number',
                    'class' => 'form-control',
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'Image d\'illustration :',
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plats::class,
        ]);
    }
}
