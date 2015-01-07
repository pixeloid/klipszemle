<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccomodationReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roomType', 'choice', array(
                'choices' => array(
                     'single' => 'Single room',
                     'double' => 'Double room'
                    )
                ))
            ->add('persons','choice', array(
                'choices' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                )
                ))
            ->add('checkIn', 'date', array(
                'years' => array('2015'),
                'data' => new \DateTime('2015-06-18')
            ))
            ->add('checkOut', 'date', array(
                'years' => array('2015'),
                'data' => new \DateTime('2015-06-21')
            ))
            ->add('accomodation', 'entity', array(
                'class' => 'PixeloidAppBundle:Accomodation',
                'property' => 'name',
                'required'    => false,
                'placeholder' => 'No need accomodation',
                'empty_data'  => null
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\AppBundle\Entity\AccomodationReservation',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_accomodationreservation';
    }
}
