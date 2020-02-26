<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,['attr' => ['class' => 'form-control mb-3']])
            ->add('password',PasswordType::class,['attr' => ['class' => 'form-control mb-3']])
            ->add('roles',ChoiceType::class,['attr' => ['class' => 'form-control mb-3'],'multiple'=>true,'choices'=>[
                'ADMINISTRATEUR' => 'ROLE_ADMIN',
                'TRAFFIC MANAGER' => 'ROLE_TRAFIC',
                'LEAD MANAGER' => 'ROLE_LEAD',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
