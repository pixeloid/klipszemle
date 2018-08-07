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

class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
                $builder
                    ->add('lead', 'ckeditor', array('label' => 'Program bevezető'))
                    ->add('day1', 'ckeditor', array('label' => '1. nap'))
                    ->add('day2', 'ckeditor', array('label' => '2. nap'))
                    ->add('submit', 'submit')


                ;


    }
    



    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_document';
    }
}
