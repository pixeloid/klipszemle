<?php

namespace Pixeloid\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccomodationType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'class' => 'PixeloidAppBundle:Room',
            'property' => 'accomodation.name',
            'expanded' => 'true'
        ));
    }

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'accomodation';
    }
}