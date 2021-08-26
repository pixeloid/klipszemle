<?php

namespace App\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\UserTitle;
use App\Entity\BudgetCategory;
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
                    ->add('user_title', EntityType::class, array(
                        'label' => 'Jogcím',
                        'class'   => UserTitle::class,
                        'choice_label' => 'name',
                       // 'attr' => array('class' => 'selectpicker')
                        )
                    )
                    ->add('email', null, array('label' => 'E-mail'))
                    ->add('phone', null, array('label' => 'Telefonszám'))

                    ;

                break;
            case 2:
            $builder
                ->add('author', null, array('label' => 'Előadó'))
                ->add('songtitle', null, array('label' => 'Dal címe'))
                ->add('video_publish_date', null, array('widget' => 'single_text', 'label' => 'A klip megjelenése', 'attr' => array('class' => 'datepicker')))
                ->add('producer', null, array('label' => 'Gyártócég'))
                ->add('director', null, array('label' => 'Rendező'))
                ->add('photographer', null, array('label' => 'Operatőr'))
                ->add('designer', null, array('label' => 'Látványtervező'))
                ->add('editor', null, array('label' => 'Vágó'))
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
                ->add('extra_info', null, array('label' => 'Extra fontos információm van'))
                ->add('premiere', null, array('label' => 'A Klipszemlén szeretném premierezni a klipet.'))
                ->add('accept_terms', CheckboxType::class, array(
                    'label' => 'Az Adatvédelmi feltételeket elolvastam és elfogadom;  
                    Rendelkezem a klip nevezéséhez szükséges jogokkal/engedélyekkel; 
                    A klip magyar vonatkozású, vagyis a rendező, az operatőr és/vagy az előadó magyar; 
                    A nevezéssel tudomásul veszem, hogy a klip vagy annak részlete a Klipszemlén készülő beszámolókban megjelenhet, felhasználásidíj-fizetésre a szervezőség nem kötelezhető.'
                ))



                ;

                break;
            case 3:

            // $builder
            // ->add('have_rights', CheckboxType::class, array('label' => 'Jogosultságom van a klipet nevezni'))
            // ->add('recaptcha', EWZRecaptchaType::class, array(
            //         'attr'        => array(
            //             'options' => array(
            //                 'theme' => 'light',
            //                 'type'  => 'image',
            //                 'size' => 'compact',
            //                 'type'  => 'image'

            //             )
            //         ),
            // ));
            // ;

                break;


        }

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {   

        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\EventRegistration',
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
