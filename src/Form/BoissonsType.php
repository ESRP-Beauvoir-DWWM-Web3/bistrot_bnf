<?php

namespace App\Form;

use App\Entity\Boissons;
use App\Entity\BoissonsCategorie;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BoissonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => BoissonsCategorie::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boissons::class,
        ]);
    }
}
