<?php

use Symfony\Component\Translation\TranslatorInterface;

include_once __DIR__ . '/../Qcm.php';

class HealthCheckoutStep extends AbstractCheckoutStep
{

    /** @var QcmOrder */
    protected $module;

    /** @var string $height */
    protected $height;

    /** @var string $weight */
    protected $weight;
    
    /** @var string $age */
    protected $age;

    public function __construct(
        Context $context,
        TranslatorInterface $translator,
        QcmOrder $module
    )
    {
        parent::__construct($context, $translator);
        $this->module = $module;
        $this->setTitle('Health Questionnaire');
    }


    /**
     * Get data to persist
     *
     * @return array step
     */
    public function getDataToPersist()
    {
        return array(
            'height' => $this->height,
            'weight' => $this->weight,
            'age' => $this->age,
        );
    }

    /**
     * Restoration data persisted of step
     *
     * @param array $data
     * @return $this|AbstractCheckoutStep
     */
    public function restorePersistedData(array $data)
    {
        $qcm = new Qcm($this->getCheckoutSession()->getCustomer()->id);

        if (array_key_exists('height', $data)) {
            $this->height = $qcm->height;
        }

        if (array_key_exists('weight', $data)) {
            $this->weight = $qcm->weight;
        }

        if (array_key_exists('age', $data)) {
            $this->age = $qcm->age;
        }

        return $this;
    }

    /**
     * Handling data from request
     * @param array $requestParameters
     * @return $this
     */
    public function handleRequest(array $requestParameters = array())
    {
        if (isset($requestParameters['submitCustomStep'])) {

            $qcm = new Qcm($this->getCheckoutSession()->getCustomer()->id);
            $qcm->height = $requestParameters['height'];
            $qcm->weight = $requestParameters['weight'];
            $qcm->age = $requestParameters['age'];
            $qcm->save();

            //to next step
            $this->setComplete(true);
            
            //Code 1.7.6
            if (version_compare(_PS_VERSION_, '1.7.6') > 0) {
                $this->setNextStepAsCurrent();
            } else {
                $this->setCurrent(false);
            }
        }

        return $this;
    }

    /**
     * Display the step
     *
     * @param array $extraParams
     * @return string
     */
    public function render(array $extraParams = [])
    {
        $defaultParams = array(
            'identifier' => 'test',
            'position' => 3, //La position n'est qu'indicative ...
            'title' => $this->getTitle(),
            'step_is_complete' => (int)$this->isComplete(),
            'step_is_reachable' => (int)$this->isReachable(),
            'step_is_current' => (int)$this->isCurrent(),
            'height' => $this->height,
            'weight' => $this->weight,
            'age' => $this->age,
        );

        $this->context->smarty->assign($defaultParams);
        return $this->module->display(
            _PS_MODULE_DIR_ . $this->module->name,
            'views/templates/front/healthCheckoutStep.tpl'
        );
    }
}
