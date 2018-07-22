<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Email', EmailType::class)
            ->add('Nombre', TextType::class)
            ->add('TipoUsuario',ChoiceType::class, array(
                'choices' => ["TECNICO" =>"tecnico", "NORMAL"=>"normal"],
                'choices_as_values' => true,'multiple'=>false,'expanded'=>true

            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña','attr'=>array('class'=>'form-control')),
                'second_options' => array('label' => 'Repita Contraseña','attr'=>array('class'=>'form-control')),
            ))
            ->add('Registrar',SubmitType::class ,array('label'=>'Registrar','attr'=>array('class'=>'btn btn-success') ))
        ;

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuarios',
            'csrf_protection' => false,
            'cascade_validation' => true,
            'allow_extra_fields' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuarios';
    }


}
