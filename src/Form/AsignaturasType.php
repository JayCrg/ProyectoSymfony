<?php

namespace App\Form;

use App\Entity\Asignaturas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignaturasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Introduce el nombre de la asignatura',
                    'class' => 'form-control',
                ],
            ])
            ->add('curso', null, [
                'label' => 'Curso',
                'attr' => [
                    'placeholder' => 'Introduce el curso de la asignatura',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignaturas::class,
        ]);
    }
}
