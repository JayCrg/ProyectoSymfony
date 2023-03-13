<?php

namespace App\Form;

use App\Entity\Alumnos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumnosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Introduce el nombre del alumno',
                    'class' => 'form-control',
                ],
            ])
            ->add('apellidos', null, [
                'label' => 'Apellidos',
                'attr' => [
                    'placeholder' => 'Introduce los apellidos del alumno',
                    'class' => 'form-control',
                ],
            ])
            ->add('sexo', null, [
                'label' => 'Sexo',
                'attr' => [
                    'placeholder' => 'Introduce el sexo del alumno',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alumnos::class,
        ]);
    }
}
