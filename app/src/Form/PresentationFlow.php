<?php

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Craue\FormFlowBundle\Form\FormFlowEvents;
use Craue\FormFlowBundle\Event\GetStepsEvent;
use Craue\FormFlowBundle\Event\PostBindFlowEvent;
use Craue\FormFlowBundle\Event\PostBindRequestEvent;
use Craue\FormFlowBundle\Event\PostBindSavedDataEvent;
use Craue\FormFlowBundle\Event\PostValidateEvent;
use Craue\FormFlowBundle\Event\PreBindEvent;

class PresentationFlow extends FormFlow implements EventSubscriberInterface
{

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType)
    {
        $this->formType = $formType;
    }

    // public function getFormOptions($step, array $options = array()) {
    //     $options = parent::getFormOptions($step, $options);

    //     $options['cascade_validation'] = true;
    //     $options['validation_groups'] = function(FormInterface $form) use ($step){
    //         $data = $form->getData();
    //         return array('paymentMethod' . ucfirst($data->getPaymentMethod()), 'flow_presentation_step'.$step);
    //     };
    //     return $options;
    // }


    public function getName(): string
    {
        return 'presentation';
    }

    protected function loadStepsConfig(): array
    {
        return array(
            array(
                'label' => 'Személyes adatok, szerzők',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Absztrakt feltöltése',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Ellenőrzés',
                'type' => $this->formType,

            ),
        );
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        parent::setEventDispatcher($dispatcher);
        $dispatcher->addSubscriber($this);
    }

    #[ArrayShape([FormFlowEvents::PRE_BIND => "string",
        FormFlowEvents::GET_STEPS => "string",
        FormFlowEvents::POST_BIND_SAVED_DATA => "string",
        FormFlowEvents::POST_BIND_FLOW => "string",
        FormFlowEvents::POST_BIND_REQUEST => "string",
        FormFlowEvents::POST_VALIDATE => "string"])] public static function getSubscribedEvents(): array
    {
        return array(
            FormFlowEvents::PRE_BIND => 'onPreBind',
            FormFlowEvents::GET_STEPS => 'onGetSteps',
            FormFlowEvents::POST_BIND_SAVED_DATA => 'onPostBindSavedData',
            FormFlowEvents::POST_BIND_FLOW => 'onPostBindFlow',
            FormFlowEvents::POST_BIND_REQUEST => 'onPostBindRequest',
            FormFlowEvents::POST_VALIDATE => 'onPostValidate',
        );
        }

        public function onPreBind(PreBindEvent $event)
        {
            // ...
        }

        public function onGetSteps(GetStepsEvent $event)
        {
            // ...
        }

        public function onPostBindSavedData(PostBindSavedDataEvent $event)
        {
            // ...
        }

        public function onPostBindFlow(PostBindFlowEvent $event)
        {
            // ...
        }

        public function onPostBindRequest(PostBindRequestEvent $event)
        {
            // ...
        }

        public function onPostValidate(PostValidateEvent $event)
        {
        }
}
