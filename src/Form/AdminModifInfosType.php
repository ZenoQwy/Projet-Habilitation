<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AdminModifInfosType extends AbstractType
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
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER', 
                    'Rédacteur' => 'ROLE_REDACTEUR', 
                    'Administrateur' => 'ROLE_ADMIN', 
                ],
                'multiple' => true, 
                'expanded' => false, 
                'attr' => ['class'=> 'text-capitalize text-black form-control'], 'label_attr' => ['class'=> 'text-white  fw-bold'],
                'label' => 'Rôle',
            ])
            ->add('isVerified', CheckboxType::class, [
                'attr' => ['class' => 'mx-2 my-3 form-check-input', 'style' => 'background-color: black;'],
                'label' => 'Vérifié',
                'label_attr' => ['class'=> 'fw-bold text-white py-3'],
                'required' => false,
            ])
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
