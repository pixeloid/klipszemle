<?php

namespace Pixeloid\AppBundle\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Pixeloid\AppBundle\Entity\UserTitle;
use Pixeloid\AppBundle\Entity\BudgetCategory;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

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
                    ->add('user_title', EntityType::class, array(
                        'label' => 'Jogcím',
                        'class'   => UserTitle::class,
                        'choice_label' => 'name',
                       // 'attr' => array('class' => 'selectpicker')
                        )
                    )
                    ->add('website', null, array('label' => 'Webcím'))
                    ->add('email', null, array('label' => 'E-mail'))
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
                ->add('song_publish_date', TextType::class, array(
                    'label' => 'A dal megjelenése', 
                    'required' => false,
                    'attr' => array('class' => 'datepicker','input_group' => array(
                'append' => '<i class="fa fa-calendar"></i>',
            ))))
                ->add('video_publish_date', TextType::class, array('label' => 'A klip megjelenése', 'attr' => array('class' => 'datepicker','input_group' => array(
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
                ->add('budget_category', EntityType::class, array(
                        'label' => 'Budget',
                        'class'   => BudgetCategory::class,
                        'choice_label' => 'name',
                        'placeholder' => 'Válassz...',
                        'required' => false,

                    )
                )

                ->add('description', TextareaType::class, array('label' => 'Valamit még mondanál?', 
                    'required' => false,
                    'attr' => array('rows' => 5)))
                ->add('video_url', TextType::class, array('label' => 'A klip youtube linkje'))

                // ->add('moviecategories', EntityType::class, array(
                //     'label' => 'Melyik kategóriákba nevezed? (maximum 3)',
                //     'multiple' => true,
                //     'mapped' => false,
                //     'expanded' => true,
                //             'class'   => 'PixeloidAppBundle:MovieCategory',
                //             'choice_label' => 'name'
                //     )
                // )

                ;

                break;
            case 3:

            $builder
            ->add('have_rights', CheckboxType::class, array('label' => 'Jogosultságom van a klipet nevezni'))
            ->add('accept_terms', CheckboxType::class, array('label' => '<a href="/privacy" target="_blank" onclick="">Elfogadom a feltételeket</a>'))
            ->add('recaptcha', EWZRecaptchaType::class, array(
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
    public function getBlockPrefix()
    {
        return 'pixeloid_appbundle_eventregistration';
    }
}
