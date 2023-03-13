<?php

namespace App\Form;

use App\Entity\Cursos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Introduce el nombre del curso',
                    'class' => 'form-control',
                ],
            ])
            ->add('numero' , null, [
                'label' => 'Número',
                'attr' => [
                    'placeholder' => 'Introduce el número del curso',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cursos::class,
        ]);
    }
}
