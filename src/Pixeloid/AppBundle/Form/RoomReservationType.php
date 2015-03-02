<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class RoomReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persons','hidden', array(
                'data' => 1
                ))
            ->add('checkIn', 'date', array(
                'years' => array('2015'),
                'data' => new \DateTime('2015-05-23'),
                'label' => 'form.label.checkin'
            ))
            ->add('checkOut', 'date', array(
                'years' => array('2015'),
                'data' => new \DateTime('2015-05-24'),
                'label' => 'form.label.checkout'

            ))
            ->add('roommate', null, array('label' => 'form.label.roommate'))
            ->add('room', 'entity', array(
                'class' => 'PixeloidAppBundle:Room',
                'mapped' => true,
                'property' => 'roomType.name',
                'group_by' => 'accomodation.name',
                'label' => 'form.label.roomtype',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('r')
                        ->join('r.accomodation', 'a')
                        ->join('r.event', 'e')
                        ->where('e.id = :event_id')
                        ->setParameter('event_id', 2)
                        ->distinct(true)
                    ;

                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\AppBundle\Entity\RoomReservation',
            'translation_domain'     => 'form'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_roomreservation';
    }
}
