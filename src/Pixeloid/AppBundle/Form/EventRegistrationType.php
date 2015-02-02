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
                        'data' => 1,
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
                        'data' => 1,
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
                        'data' => 1,
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

                $builder->add('diningReservation', new DiningReservationType())
                ;

                break;
            case 4:

                $builder
                    ->add('paymentMethod', 'choice', array(
                        'choices'   => array(
                            'transfer' => 'Banki átutalás', 
                            'sponsored' => 'Szponzorált részvétel', 
                        ),
                        'expanded'  => true,
                        'data' => 'transfer'
                    ))
                    ->add('invoiceType', 'choice', array(
                        'choices'   => array(
                            'elolegszamla' => 'Előleg számla', 
                            'elolegbekero' => 'Előlegbekérő', 
                            'eloreutalas' => 'Előre utalás', 
                        ),
                        'expanded'  => true,
                        'data' => 'elolegszamla'
                    ))
                    ->add('billingName')
                    ->add('billingAddress')
                    ->add('billingContactPerson');

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
