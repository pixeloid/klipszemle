<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DiningReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dinings', 'entity', array(
                'class' => 'PixeloidAppBundle:DiningDate',
                'mapped' => false,
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


    }
    

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\AppBundle\Entity\DiningReservation',
        ));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_diningreservation';
    }
}
