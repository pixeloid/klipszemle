<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\FormInterface;
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
                        'label'     => 'form.label.registranttype',
                        'placeholder' => 'Válasszon...',
                        'empty_data'  => null
                    ))

                    ->add('reg_number', null, array('label' => 'form.label.regnumber'))
                    ->add('firstname', null, array('label' => 'form.label.firstname'))
                    ->add('lastname', null, array('label' => 'form.label.lastname'))
                    ->add('title', 'choice', array(
                        'choices'   => array(
                            // 'Mr.' => 'Mr.', 
                            // 'Mrs.' => 'Mrs.', 
                            // 'Ms.' => 'Ms.',
                            'Dr.' => 'Dr.',
                            'Prof.' => 'Prof',
                            'dr.' => 'dr.'
                        ),
                        'label' => 'form.label.title',
                        'required'  => true,
                    ))
                    ->add('institution', null, array('label' => 'form.label.institution'))
                    ->add('country', 'country', array('label' => 'form.label.country', 'data' => 'HU'))
                    ->add('city', null, array('label' => 'form.label.city'))
                    ->add('address', null, array('label' => 'form.label.address'))
                    ->add('phone', null, array('label' => 'form.label.phone'))
                    ->add('fax', null, array('label' => 'form.label.fax'))
                    ->add('email', null, array('label' => 'form.label.email'))
                    ->add('postal', null, array('label' => 'form.label.postal'))
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
                    ->add('invoiceTypeSponsored', 'choice', array(
                        'choices'   => array(
                            'elolegszamla' => 'Előleg számla', 
                            'elolegbekero' => 'Előlegbekérő', 
                        ),
                        'expanded'  => true,
                        'data' => 'elolegszamla'
                    ))
                    ->add('billingNameSponsored')
                    ->add('billingAddressSponsored')
                    ->add('billingContactPersonSponsored')
                    ->add('billingNameTransfer')
                    ->add('billingAddressTransfer');

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
            'data_class' => 'Pixeloid\AppBundle\Entity\EventRegistration',
            'translation_domain'     => 'form'
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
