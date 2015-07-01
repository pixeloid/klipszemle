<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PresentationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body1', null, array(
                'label' => 'Bevezetés',
                'attr' => array('rows' => 3)
                ))
            ->add('body2', null, array(
                'label' => 'Esetismertetés',
                'attr' => array('rows' => 10)
                ))
            ->add('body3', null, array(
                'label' => 'Következtetés',
                'attr' => array('rows' => 3)
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\AppBundle\Entity\Presentation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_presentation';
    }
}
