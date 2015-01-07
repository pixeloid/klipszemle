<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Entity\AccomodationReservation;

class EventRegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        switch ($options['flow_step']) {
            case 1:
                $builder
                    ->add('firstname', null, array('label' => 'First name'))
                    ->add('lastname', null, array('label' => 'Last name'))
                    ->add('title', 'choice', array(
                        'choices'   => array(
                            'Mr.' => 'Mr.', 
                            'Mrs.' => 'Mrs.', 
                            'Ms.' => 'Ms.',
                            'Dr.' => 'Dr.',
                            'Prof.' => 'Prof',
                            'dr.' => 'dr.'
                        ),
                        'required'  => true,
                    ))
                    ->add('institution')
                    ->add('country', 'country')
                    ->add('city')
                    ->add('address')
                    ->add('phone')
                    ->add('fax')
                    ->add('email')
                    ->add('postal');

                break;
            case 2:
                $builder->add('recaptcha', 'ewz_recaptcha')
                        ->add('reservation', new AccomodationReservationType(), array(
                            'data_class' => 'Pixeloid\AppBundle\Entity\AccomodationReservation'
                        ));

                break;
        }


        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\AppBundle\Entity\EventRegistration'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_eventregistration';
    }
}
