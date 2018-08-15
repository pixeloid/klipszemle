<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\IsTrue;

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
                    ->add('name', null, array('label' => 'Név'))
                    ->add('company', null, array('label' => 'Cégnév'))
                    ->add('user_title', 'entity', array(
                        'label' => 'Jogcím',
                        'class'   => 'PixeloidAppBundle:UserTitle',
                        'property' => 'name',
                       // 'attr' => array('class' => 'selectpicker')
                        )
                    )
                    ->add('website', null, array('label' => 'Webcím'))
                    ->add('email', null, array('label' => 'form.label.email'))
                    ->add('phone', null, array('label' => 'Telefonszám', 'attr' => array('data-mask' => '(#0) 000-0000', 'placeholder' => '(55) 555-5555')))
                    ->add('address', null, array('label' => 'Postacím'))

                    ;

                break;
            case 2:
            $builder
                ->add('author', null, array('label' => 'Előadó'))
                ->add('songtitle', null, array('label' => 'Dal címe'))
                ->add('length', null, array('label' => 'Hossz (min:sec)', 'attr' => array('data-mask' => '00:00', 'placeholder' => '00:00')))
                ->add('publisher', null, array('label' => 'Kiadó'))
                ->add('song_publish_date', 'text', array(
                    'label' => 'A dal megjelenése', 
                    'required' => false,
                    'attr' => array('class' => 'datepicker','input_group' => array(
                'append' => '<i class="fa fa-calendar"></i>',
            ))))
                ->add('video_publish_date', 'text', array('label' => 'A klip megjelenése', 'attr' => array('class' => 'datepicker','input_group' => array(
                'append' => '<i class="fa fa-calendar"></i>',
            ))))
                ->add('producer', null, array('label' => 'Gyártócég'))
                ->add('director', null, array('label' => 'Rendező'))
                ->add('photographer', null, array('label' => 'Operatőr'))
                ->add('designer', null, array('label' => 'Látványtervező'))
                ->add('editor', null, array('label' => 'Vágó'))
                ->add('technology', null, array(
                    'label' => 'Rögzítéstechnika',
                    )
                )
                ->add('budget_category', 'entity', array(
                        'label' => 'Budget',
                        'class'   => 'PixeloidAppBundle:BudgetCategory',
                        'property' => 'name',
                  //      'attr' => array('class' => 'selectpicker')
                        'required' => false,

                    )
                )

                ->add('description', 'textarea', array('label' => 'Valamit még mondanál?', 
                    'required' => false,
                    'attr' => array('rows' => 5)))
                ->add('video_url', 'text', array('label' => 'A klip youtube linkje'))

                // ->add('moviecategories', 'entity', array(
                //     'label' => 'Melyik kategóriákba nevezed? (maximum 3)',
                //     'multiple' => true,
                //     'mapped' => false,
                //     'expanded' => true,
                //             'class'   => 'PixeloidAppBundle:MovieCategory',
                //             'property' => 'name'
                //     )
                // )

                ;

                break;
            case 3:

            $builder
            ->add('have_rights', 'checkbox', array('label' => 'Jogosultságom van a klipet nevezni'))
            ->add('accept_terms', 'checkbox', array('label' => '<a href="/privacy" target="_blank" onclick="">Elfogadom a feltételeket</a>'))
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
