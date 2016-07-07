<?php

namespace pythagor\yiiphpab;

use CApplicationComponent;
use CBaseController;
use Yii;

class YiiPhpab extends CApplicationComponent
{
    /**
     * @var PhpabTest[]
     */
    private $tests = [];

    /**
     * @var AbTestFactory
     */
    private $abTestFactory;

    public function init()
    {
        parent::init();
        $this->setFactory(new AbTestFactory());
        Yii::app()->controller->attachEventHandler('onAfterRender', [$this, 'runTest']);
    }

    public function setFactory(AbTestFactoryInterface $factory)
    {
        $this->abTestFactory = $factory;
    }

    public function addTest($name, CBaseController $owner, $isTrialMode = PhpabTest::MODE_TRIAL)
    {
        $test = new PhpabTest($name, $owner, $isTrialMode);
        $this->tests[$name] = $test;

        return $test;
    }

    public function runTest()
    {
        $i = 0;
        foreach ($this->tests as $testName => $test) {
            $i++;
            $testInstance = $this->abTestFactory->getAbTestInstance($testName, $test->getIsTrialMode());
            $testInstance->set_ga_slot((string)$i);
            foreach ($test->getVariations() as $variation) {
                $testInstance->add_variation($variation->getName(), $variation->getValue());
            }
        }
    }
}
