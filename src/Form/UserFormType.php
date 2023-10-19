<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// Importez la classe PasswordType
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    //         ->add('username')
    //         ->add('firstname')
    //         ->add('lastname')
    //         ->add('password')
    //         ->add('email')
    //         ->add('createdAt')
    //     ;
    // }


    ->add('username', null, [
        'constraints' => [
            new Assert\NotBlank(['message' => 'Le pseudo est requis.']),
            new Assert\Length([
                'max' => 255,
                'maxMessage' => 'Le pseudo ne peut pas dépasser {{ limit }} caractères.',
            ]),
        ],
    ])

    
    ->add('firstname', null, [
        'constraints' => [
            new Assert\NotBlank(['message' => 'Le nom est requis.']),
            new Assert\Length([
                'min' => 2,
                'max' => 255,
                'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
            ]),
        ],
    ])
    ->add('lastname', null, [
        'constraints' => [
            new Assert\NotBlank(['message' => 'Le prénom est requis.']),
            new Assert\Length([
                'min' => 2,
                'max' => 255,
                'minMessage' => 'Le prénom doit comporter au moins {{ limit }} caractères.',
                'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
            ]),
        ],
    ])

    ->add('email', null, [
        'constraints' => [
            new Assert\NotBlank(['message' => 'L\'email est requis.']),
            new Assert\Email(['message' => 'L\'email n\'est pas valide.']),
        ],
    ])

    
        ->add('password', PasswordType::class, [ // Utilisez PasswordType::class
            'constraints' => [
            new Assert\NotBlank(['message' => 'Le mot de passe est requis.']),
            new Assert\Length([
                'min' => 10,
                'max' => 1000,
                'minMessage' => 'Le mot de passe doit comporter au moins {{ limit }} caractères.',
                'maxMessage' => 'Le mot de passe ne peut pas dépasser {{ limit }} caractères.',
            ]),
        ],
    ])
   
        ->add('passwordConfirm', PasswordType::class)
    
        // ->add('send', SubmitType::class)
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
