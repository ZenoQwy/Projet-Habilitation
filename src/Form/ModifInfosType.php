<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ModifInfosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class'=> 'mb-4 text-capitalize text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('prenom', TextType::class, ['attr' => ['class'=> 'mb-4 text-capitalize text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('email', EmailType::class, ['attr' => ['class'=> 'mb-4 text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('adresse', TextType::class, ['attr' => ['class'=> 'mb-4 text-capitalize text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('ville', TextType::class, ['attr' => ['class'=> 'mb-4 text-capitalize text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('cp', IntegerType::class, ['attr' => ['class'=> 'mb-4 text-black form-control'], 'label_attr' => ['class'=> 'text-white fw-bold']])
            ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
