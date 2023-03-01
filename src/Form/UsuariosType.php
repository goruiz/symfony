<?php

namespace App\Form;
use App\Entity\Ciudades;
use App\Entity\Paises;
use App\Entity\Usuarios;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;



class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[
                'label' => "Nombre de usuario *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Usuario "
                ],
              
            ])

            ->add('correo',EmailType::class,[
                'label' => "Correo del usuario *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Correo"
                ],
              ])
            ->add('telefono',TextType::class,[
                'label' => "Telefono del Usuario *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Telefono"
                ],
              ])
            ->add('direccion',TextType::class,[
                'label' => "Direccion del usuario *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Direccion "
                ],
              ])
              
            ->add('ciudad', EntityType::class, [
                'label' => "Ciudad Usuario*",
                'class' => Ciudades::class,
                'placeholder' => "Selecione una Ciudad",
                'query_builder' => function (EntityRepository $er) {
                 return $er->createQueryBuilder('c')
                         ->where('c.estado = :estado')
                         ->setParameter('estado', true)
                         ->orderBy('c.nombre', 'ASC');
                     },
                'choice_label' => function ($ciudad) {
                    return $ciudad->getNombre() ;
                },
                'multiple' => false,
                'expanded' => false,
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
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
            'data_class' => Usuarios::class,
        ]);
    }
}
