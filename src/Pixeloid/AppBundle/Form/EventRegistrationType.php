<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Entity\RoomReservation;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;

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
                    ->add('registrantType', 'entity', array(
                        'class' => 'PixeloidAppBundle:RegistrantType',
                        'property' => 'name',
                        'required'    => false,
                        'placeholder' => 'Válasszon...',
                        'empty_data'  => null
                    ))

                    ->add('reg_number', null, array('label' => 'Pecsétszám'))
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
                    ->add('postal')
                    ->add('extra1', 'choice', array(
                        'choices'   => array(
                            1   => 'Részt veszek',
                            0 => 'Nem veszek részt',
                        ),
                        'preferred_choices' => array(1), //1 is item number
                        'multiple'  => false,
                        'expanded'  => true,
                        'mapped' => false,
                        'label' => 'A továbbképző napon'
                    ))

                    ->add('extra2', 'choice', array(
                        'choices'   => array(
                            1   => 'Részt veszek',
                            0 => 'Nem veszek részt',
                        ),
                        'preferred_choices' => array(1), //1 is item number
                        'multiple'  => false,
                        'expanded'  => true,
                        'mapped' => false,
                        'label' => 'Mentő oktatópont workshopon'
                    ))

                    ->add('extra3', 'choice', array(
                        'choices'   => array(
                            1   => 'Részt veszek',
                            0 => 'Nem veszek részt',
                        ),
                        'preferred_choices' => array(1), //1 is item number
                        'multiple'  => false,
                        'expanded'  => true,
                        'mapped' => false,
                        'label' => 'UH oktatás workshopon'
                    ))

                    // ->add('roomReservations', 'collection', array(
                    //     'type' => new RoomReservationType,
                    //   //  'mapped'   => false,

                    // ))
                    // ->add('gender', 'choice', array(
                    //     'choices'   => array('m' => 'Male', 'f' => 'Female'),
                    //     'required'  => false,
                    //     'mapped' => false,
                    //     'expanded' => true,
                    //     'multiple' => true
                    // ));


                    ;

                break;
            case 2:
                $builder

                        ->add('roomReservation', new RoomReservationType(), array(
                            'data_class' => 'Pixeloid\AppBundle\Entity\RoomReservation'
                        ))

                        ;
                break;
            case 3:

                $builder

                ->add('diningDates', 'entity', array(
                        'class' => 'PixeloidAppBundle:DiningDate',
                        'mapped' => true,
                        'property' => 'dining.diningType.name',
                        'group_by' => 'dining.id',
                        'multiple' => true,
                        'expanded' => true,
                        'query_builder' => function(EntityRepository $er){
                            return $er->createQueryBuilder('dd')
                                ->join('dd.dining', 'd')
                                ->join('d.diningType', 't')
                                ->join('d.event', 'e')
                                ->where('e.id = :event_id')
                                ->setParameter('event_id', 2)
                                ->orderBy('dd.date', 'ASC')
                                ->distinct(true)
                            ;

                        }
                    ))



                    ;
                break;
            case 4:
                break;
            case 5:
                $builder

                        ->add('recaptcha', 'ewz_recaptcha')
                        ;
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
