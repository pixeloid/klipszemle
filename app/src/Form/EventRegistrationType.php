<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
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
        
            $builder
                ->add('author', null, array('label' => 'Előadó'))
                ->add('songtitle', null, array('label' => 'Dal címe'))
                ->add('video_publish_date', null, ['widget' => 'single_text',
                    'label' => 'A klip megjelenése',
                    'attr' => ['class' => 'datepicker-input'],
                    'help' => '2021.09.13. óta megjelent, 
                    a 2021-es Klipszemlén versenybe nem került videók nevezhetők.',
                        ])
                ->add('producer', null, array('label' => 'Gyártócég'))
                ->add('director', null, array('label' => 'Rendező'))
                ->add('photographer', null, array('label' => 'Operatőr'))
                ->add('designer', null, array('label' => 'Látványtervező'))
                ->add('stylist', null, array('label' => 'Stylist'))
                ->add('editor', null, array('label' => 'Vágó'))
                ->add('budget_category', EntityType::class, array(
                        'label' => 'Budget',
                        'class'   => BudgetCategory::class,
                        'choice_label' => 'name',
                        'placeholder' => 'Válassz...',
                        'required' => false,
                    ))
                ->add('description', TextareaType::class, array('label' => 'Valamit még mondanál a klipről?',
                    'required' => false,
                    'attr' => array('rows' => 5)))
                ->add('video_url', TextType::class, [
                    'label' => 'A klip youtube linkje',
                    'help' => 'Ha a szemlén premiereztetsz, vagy még félkész a klip és egy egy kamu link, ne felejtsd el kipipálni az erre vonatkozó részt később!'])
                ->add('extra_info', null, array('label' => 'Extra fontos információm van'))
                ->add('premiere', null, ['label' => 'A Klipszemlén szeretném premierezni a klipet.',
                    'help' => 'A klip előadója, stábja, a menedzsment, a kiadó és minden érintett tudomásul veszi, hogy 2022.10.13. előtt nem kerülhet nyilvánosságra a videó, ezért a klip a közönségszavazáson sem vesz részt. Ha nem pipálod ezt be, kikerül közönségszavazásra a linkelt videó.
A végleges változatot LEGKÉSŐBB 2022.09.20-ig kérjük eljuttatni az info.klipszemle@gmail.com címre.'])
                ->add('no_premiere', null, ['label' => 'Nem a Klipszemlén premiereztetek, de még nincs kész a klip.',
                    'help' => 'Ha kamu linket vagy nem végleges verziót adtál meg a YouTube-linknél, ezt mindenképp pipáld, nehogy kimenjen véletlenül közönségszavazásra.
És várjuk a végleges változatot LEGKÉSŐBB 2022.09.08-ig az info.klipszemle@gmail.com címre. Amennyiben ezt nem tudod tartani, úgy nem áll módunkban a szemlén premierezni a videót. Ugyanitt szeretnénk jelezni, hogy nem minden premieres nevezést vetítünk le a szemlén. A beérkező klipekből csinálunk egy válogatást, ami bemutatásra kerül. Erről későbbiekben értesítünk.'])
                ->add('accept_terms', null, array(
                    'label' => 'A Magyar Klipszemle adatvédelmi feltételeit elolvastam és elfogadom.',
                    'help' => 'Rendelkezem a klip nevezéséhez szükséges jogokkal/engedélyekkel. A klip magyar vonatkozású, vagyis a rendező, az operatőr és/vagy az előadó magyar. A nevezéssel tudomásul veszem, hogy a klip, vagy annak részlete a Klipszemlén készülő beszámolókban megjelenhet, felhasználásidíj-fizetésre a szervezőség nem kötelezhető.'
                ))
                ->add('submit', SubmitType::class, [
                    'label' => 'Beküldés'
                ])
            ;
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
