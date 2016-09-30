<?php

namespace SisUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class Users1Type extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName',TextType::class)
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('password',PasswordType::class)
            ->add('role',ChoiceType::class, array(
                'choices' => array(
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_USER' => 'ROLE_USER'
                ),'placeholder' => 'Select a role'))
            ->add('isActive',CheckboxType::class,
                   array(
                   'label'     => 'Show this entry publicly?',
                   'required' => false,))
         /* los borramos porque se crean automaticamente
            ->add('createdAt', DateTimeType::class)
            ->add('updateAt', DateTimeType::class) */
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SisUserBundle\Entity\Users1'
        ));
    }
}
