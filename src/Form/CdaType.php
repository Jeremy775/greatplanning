<?php

namespace App\Form;

use App\Entity\Cda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CdaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', ChoiceType::class, [
                'choices' => [
                    'PHP' => 'PHP',
                    'Java Poo' => 'Java Poo',
                    'Anglais' => 'Anglais'
                    // ajouter cours
                ]
            ])
            ->add('all_day')
            ->add('start', DateTimeType::class, ['date_widget' => 'single_text'])
            ->add('description')
            ->add('background_color', ColorType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cda::class,
        ]);
    }
}
