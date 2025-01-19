<?php

namespace App\Form;

use App\Entity\Oficina;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OficinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero', NumberType::class, [
                'label' => 'Número de oficina'
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre de la oficina'
            ])
            ->add('direccion', TextType::class, [
                'label' => 'Dirección'
            ])
            ->add('ciudad', TextType::class, [
                'label' => 'Ciudad'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oficina::class,
        ]);
    }
}
