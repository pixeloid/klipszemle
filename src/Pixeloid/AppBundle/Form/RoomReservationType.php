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
            ->add('room', 'entity', array(
                'class' => 'PixeloidAppBundle:Room',
                'mapped' => true,
                'property' => 'roomType.name',
                'group_by' => 'accomodation.name',
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
