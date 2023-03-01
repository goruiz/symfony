<?php

namespace App\Form;

use App\Entity\Ciudades;
use App\Entity\Paises;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CiudadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => "Nombre de la Ciudad *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Ciudad"
                ],
            ])
            ->add('codigoIata', TextType::class, [
                'label' => "Coidgo Iata *",
                'row_attr' => [
                    'class' => 'mb-3'
                ],
                'label_attr' => [
                    'class' => 'col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Codigo Iata "
                ],
            ])
            ->add('paisId', EntityType::class, [
                'label' => "Pais",
                'class' => Paises::class,
                'placeholder' => "Selecione un Pais",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.estado = :estado')
                        ->setParameter('estado', true)
                        ->andWhere('c.fechaCreacion >= :fecha')
                        ->setParameter('fecha', "2022-11-24 00:00:00")
                        ->orderBy('c.nombre', 'ASC');
                },
                'choice_label' => function ($pais) {
                    return $pais->getNombre().", ".$pais->getAbreviatura() ;
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
            'data_class' => Ciudades::class,
        ]);
    }
}


/*

Element Type							Expanded	Multiple
select tag								false		false
select tag (with multiple attribute)	false		true
radio buttons							true		false
checkboxes								true		true

*/