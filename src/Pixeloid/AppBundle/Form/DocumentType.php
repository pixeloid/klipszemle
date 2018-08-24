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
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
                $builder
                    ->add('lead', CKEditorType::class, array('label' => 'Program bevezető'))
                    ->add('day1', CKEditorType::class, array('label' => '1. nap'))
                    ->add('day2', CKEditorType::class, array('label' => '2. nap'))
                    ->add('submit', SubmitType::class)


                ;


    }
    



    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pixeloid_appbundle_document';
    }
}
