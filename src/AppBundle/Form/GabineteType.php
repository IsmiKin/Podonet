<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GabineteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('localizacion')
            ->add('tipo')
            ->add('fechaSuspension')
            ->add('estado')
            ->add('fechaUltimaModificacion')
            ->add('usuarioCreador')
            ->add('usuarioModificacion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Gabinete'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_gabinete';
    }
}
