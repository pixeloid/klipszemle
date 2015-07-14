<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;

class PresentationType extends AbstractType
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
                ->add('name', null, array(
                    'label' => 'Beküldő neve',
                    ))

                ->add('email', null, array(
                    'label' => 'Beküldő e-mail címe',
                    ))

                ->add(
                    'authors',
                    'bootstrap_collection',
                    array(
                        'allow_add'          => true,
                        'allow_delete'       => true,
                        'add_button_text'    => 'Szerző hozzáadása',
                        'delete_button_text' => 'Szerző törlése',
                        'sub_widget_col'     => 9,
                        'button_col'         => 3,
                        'label'             => 'Szerzők (kérjük, a szerzők mellé vesszővel elválasztva az intézményt megadni!)'
                    )
                );

                break;

            case 2:
                $builder

                ->add('title', null, array(
                    'label' => 'Előadás címe',
                    ))

                    ->add('body1', 'ckeditor', array(
                        'label' => 'Tartalom',
                        'config' => array(
                        'extraPlugins' => 'wordcount',
                            'toolbar' => array(
                                // array(
                                //     'name'  => 'document',
                                //     'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                                // ),
                                // '/',
                                array(
                                    'name'  => 'basicstyles',
                                    'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                                ),
                            ),
                            'uiColor' => '#ffffff',
                            //...
                        ),
                    ));

                break;
                
            case 3:


                $builder

                        ->add('recaptcha', 'ewz_recaptcha', array(
                                'attr'        => array(
                                    'options' => array(
                                        'theme' => 'light',
                                        'type'  => 'image',
                                        'size' => 'compact',
                                        'type'  => 'image'

                                    )
                                ),
                        ));
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
            'data_class' => 'Pixeloid\AppBundle\Entity\Presentation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pixeloid_appbundle_presentation';
    }
}
