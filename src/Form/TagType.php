<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page',EntityType::class,['class'=>Page::class,'choice_label'=>'nom','placeholder'=>'Aucune','attr' => ['class' => 'form-control mb-3']])
            ->add('libelle',TextType::class,['attr' => ['class' => 'form-control mb-3']])
            ->add('position',ChoiceType::class,['choices'=>[
                'Head' => 'head',
                'Body (Top)' => 'bodytop',
                'Body (Bottom)' => 'bodyend',
            ],
                'attr' => ['class' => 'form-control mb-3']])

            ->add('content',TextareaType::class,['attr' => ['class' => 'form-control mb-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
