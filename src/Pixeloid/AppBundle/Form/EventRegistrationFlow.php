<?php

namespace Pixeloid\AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class EventRegistrationFlow extends FormFlow {

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType) {
        $this->formType = $formType;
    }

    public function getName() {
        return 'eventRegistration';
    }

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'Personal details',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Accomodation reservation',
                'type' => $this->formType,
              //  'skip' => true,
            ),
            array(
                'label' => 'confirmation',
            ),
        );
    }
}
