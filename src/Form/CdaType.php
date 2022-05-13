<?php

namespace App\Form;

use App\Entity\Cda;
use App\Entity\Cours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CdaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('title', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'nom_cours',
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
