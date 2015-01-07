<?php

namespace Pixeloid\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserMetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('title')
            ->add('instiution')
            ->add('country')
            ->add('address')
            ->add('phone')
            ->add('fax')
            ->add('user_id')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pixeloid\UserBundle\Entity\UserMeta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_UserBundle_usermeta';
    }
}
