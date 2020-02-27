<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Page;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customColor',HiddenType::class)
            ->add('base',HiddenType::class)
            ->add('nom',TextType::class,['attr'=>['class'=>'form-control mb-3']])
            ->add('title',TextType::class,['attr'=>['class'=>'form-control mb-3']])
            ->add('description',TextType::class,['attr'=>['class'=>'form-control mb-3'],'required'=>false])
            ->add('keywords',TextType::class,['attr'=>['class'=>'form-control mb-3'],'required'=>false,'label'=> 'Keywords (séparés par une virgule)'])
            ->add('logo', FileType::class, [
                'label' => 'Logo (PNG)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                    ])
                ],
            ])
            ->add('favicon', FileType::class, [
                'label' => 'Favicon (PNG)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                    ])
                ],
            ])
            ->add('isIndexed',CheckboxType::class, ['attr'=>['class'=>'d-inline-block'],'required'=>false,'label'=>'Index','label_attr' => ['class' => 'switch-custom']])
            ->add('isFollowed',CheckboxType::class, ['attr'=>['class'=>'d-inline-block'],'required'=>false,'label'=>'Follow','label_attr' => ['class' => 'switch-custom']])
            ->add('header', TextareaType::class, ['attr' => ['class' => 'editor'],'label'=>false])
            ->add('content', TextareaType::class, ['attr' => ['class' => 'editor'],'label'=>false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
