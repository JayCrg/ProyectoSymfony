<?php

namespace App\Form;

use App\Entity\AlumAsigProf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumAsigProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nota', null, [
                'label' => 'Nota',
                'attr' => [
                    'placeholder' => 'Introduce la nota',
                    'class' => 'form-control',
                ],
            ])
            ->add('alumnoId', null, [
                'label' => 'Alumno',
                'attr' => [
                    'placeholder' => 'Introduce el alumno',
                    'class' => 'form-control',
                ],
            ])
            ->add('profId', null, [
                'label' => 'Profesor',
                'attr' => [
                    'placeholder' => 'Introduce el profesor',
                    'class' => 'form-control',
                ],
            ])
            ->add('asigId', null, [
                'label' => 'Asignatura',
                'attr' => [
                    'placeholder' => 'Introduce la asignatura',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AlumAsigProf::class,
        ]);
    }
}
