<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Simulator;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('content', TextareaType::class, ['attr' => ['hidden'=>true,'class' => 'editor hidden'],'label'=>false])
            ->add('page',EntityType::class,['class'=>Page::class,'choice_label'=>'nom','placeholder'=>'Aucune','attr' => ['class' => 'form-control mb-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Simulator::class,
        ]);
    }
}
