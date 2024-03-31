<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'label' => 'Nombre de usuario', // Change the label text if needed
            'attr' => [
                'class' => 'text-class', // Apply custom class to the input field
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
        ])
        ->add('email', TextType::class, [
            'label' => 'Email', // Change the label text if needed
            'attr' => [
                'class' => 'text-class', // Apply custom class to the input field
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Nombre', // Change the label text if needed
            'attr' => [
                'class' => 'text-class', // Apply custom class to the input field
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Apellido', // Change the label text if needed
            'attr' => [
                'class' => 'text-class', // Apply custom class to the input field
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
        ])

        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'label' => 'Constraseña',
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'text-class'
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor, ingrese una contraseña',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Tu contraseña debería tener {{ limit }} caracteres',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])

        ->add('profile_picture', FileType::class, [
            'label' => 'Profile Picture',
            'attr' => [
                'class' => 'text-class', // Apply custom class to the input field
            ],
            'label_attr' => [
                'class' => 'label-class', // Apply custom class to the label
            ],
            // unmapped means that this field is not associated with any entity property
            'mapped' => false,

            // make it optional so you don't have to re-upload the image
            // every time you edit the user's details
            'required' => false,

            // Add image file constraints
            'constraints' => [
                new File([
                    'maxSize' => '5M', // Maximum file size (adjust as needed)
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF)',
                ]),
            ],
        ])

        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label' => 'Aceptar términos y condiciones',
            'attr' => [
                'class' => 'check-class', // Apply custom class to the input field
            ],
            'constraints' => [
                new IsTrue([
                    'message' => 'Debes aceptar los terminos y condiciones.',
                ]),
            ],
        ])

        ->add(
            'roles',
            ChoiceType::class,
            [
                'choices' => array('Opciones' => [
                    'Administrador' => 'ROLE_ADMIN',
                    'Carga'         => 'ROLE_UPLOAD',
                    'Revisor'       => 'ROLE_REVIEW',
                    'Usuario'       => 'ROLE_USER'
                ]),
                'attr' => [
                    'class' => 'selector-class', // Apply custom class to the input field
                ],
                'label_attr' => [
                    'class' => 'label-class', // Apply custom class to the label
                ],
                'placeholder' => 'Seleccione un rol',
                'multiple' => true,
                'required' => true,
                'empty_data' => array('ROLE_USER'),
            ]
        )
        ->add('submit', SubmitType::class, [
            'attr' => ['class' => 'submit'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
