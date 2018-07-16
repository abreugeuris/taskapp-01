<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaCreado')
                 ->add('descripcion')
                ->add('fechaCompletado')
                ->add('usuario')
                ->add('usuarioAsignado')
                ->add('estado');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Usuario',
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
        return 'appbundle_ticket';
    }


}
