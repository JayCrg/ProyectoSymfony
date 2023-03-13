<?php

namespace App\Form;

use App\Entity\Profesores;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesoresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Introduce el nombre del profesor',
                    'class' => 'form-control',
                ],
            ])
            ->add('apellidos', null, [
                'label' => 'Apellidos',
                'attr' => [
                    'placeholder' => 'Introduce los apellidos del profesor',
                    'class' => 'form-control',
                ],
            ])
            ->add('telefono', null, [
                'label' => 'Teléfono',
                'attr' => [
                    'placeholder' => 'Introduce el teléfono del profesor',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profesores::class,
        ]);
    }
}
