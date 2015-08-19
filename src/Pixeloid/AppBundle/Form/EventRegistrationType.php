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
use Symfony\Component\Validator\Constraints\True;

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
                    ->add('title', 'choice', array(
                        'label' => 'Jogcím',
                        'choices'   => array(
                            'Rendező', 'Előadó', 'Kiadó', 'Gyártócég'
                        )
                        )
                    )
                    ->add('website', null, array('label' => 'Webcím'))
                    ->add('email', null, array('label' => 'form.label.email'))
                    ->add('phone', null, array('label' => 'Telefonszám'))
                    ->add('address', null, array('label' => 'Postacím'))

                    ;

                break;
            case 2:
            $builder
                ->add('author', null, array('label' => 'Előadó'))
                ->add('song_title', null, array('label' => 'Dal címe'))
                ->add('length', null, array('label' => 'Hossz'))
                ->add('publisher', null, array('label' => 'Kiadó'))
                ->add('song_publish_date', 'text', array('label' => 'A dal megjelenése', 'attr' => array('class' => 'datepicker')))
                ->add('video_publish_date', 'text', array('label' => 'A klip megjelenése', 'attr' => array('class' => 'datepicker')))
                ->add('producer', null, array('label' => 'Gyártócég'))
                ->add('director', null, array('label' => 'Rendező'))
                ->add('photographer', null, array('label' => 'Operatőr'))
                ->add('designer', null, array('label' => 'Látványtervező'))
                ->add('editor', null, array('label' => 'Vágó'))
                ->add('technology', null, array(
                    'label' => 'Rögzítéstechnika',
                    )
                )
                ->add('budget', 'choice', array(
                    'label' => 'Budget',
                    'choices'   => array(
                        '500 ezer alatt', '1 millió alatt', '1.5 millió alatt', '1.5 millió felett'
                    )
                    )
                )

                ->add('description', 'textarea', array('label' => 'Leírás'))
                ->add('video_url', 'text', array('label' => 'A klip youtube linkje'))

                ->add('categories', 'choice', array(
                    'label' => 'Melyik kategóriákba nevezed? (maximum 3)',
                    'multiple' => true,
                    'expanded' => true,
                    'choices'   => array(
                            'Legjobb klip',
                            'Legjobb zene',
                            'Legjobb látvány',
                            'Legjobb operatőri munka',
                            'Legjobb vágás',
                            'Legjobb rendezés',
                            'Legjobb no budget',
                            'Legjobb animáció',
                            'Legjobb 2010 előtti',
                            'Legjobb trash',

                    )
                    )
                )

                ;

                break;
            case 3:

            $builder
            ->add('have_rights', 'checkbox', array('label' => 'Jogosultságom van a klipet nevezni', 'mapped' => false, 'required' => true))
            ->add('accept_terms', 'checkbox', array('label' => '<a href="/privacy" target="_blank" onclick="">Elfogadom a feltételeket</a>', 'mapped' => false, 'required' => true, "constraints" => new True(array(
        "message" => "Kötelező mező!"))
            ))
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
