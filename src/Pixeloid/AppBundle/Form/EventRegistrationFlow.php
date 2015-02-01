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
                'label' => 'Személyes adatok',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Szállás foglalás',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Étkezés',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Fizetési feltételek',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Ellenőrzés',
                'type' => $this->formType,

            ),
        );
    }
}
