<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Simulator;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, ['attr' => ['class' => 'editor hidden'],'label'=>false])
            ->add('page',EntityType::class,['class'=>Page::class,'choice_label'=>'nom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Simulator::class,
        ]);
    }
}
