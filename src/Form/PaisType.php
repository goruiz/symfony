<?php

namespace App\Form;

use App\Entity\Paises;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints as Assert;


class PaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => "Nombre del Pais *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Ciudad "
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Error, nombre no puede estar en blanco',
                    ]),
                    new Assert\Length([
                        'min' => 5,
                        'minMessage' => 'El nombre debe tener al menos {{ limit }} caracteres'
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-z0-9-]+$/i',
                        'match'   => True,
                        'message' => 'Solo se permiten valores: a-z, 0-9'
                    ])
                ]
            ])
            ->add('abreviatura', TextType::class, [
                'label' => "Abreviatura del Pais *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Abreviatura "
                ],
            ])
            ->add('enviar', SubmitType::class, [
                'label' => "Enviar Formulario",
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paises::class,
        ]);
    }
}
