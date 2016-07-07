<?php

namespace pythagor\yiiphpab;

use CApplicationComponent;
use CBaseController;
use Yii;

/**
 * Class YiiPhpab
 * Basic extension component to manipulate A/B tests
 * @package pythagor\yiiphpab
 * @author Andrei Chugunov <admin@pythagor.com>
 */
class YiiPhpab extends CApplicationComponent
{
    /**
     * @var PhpabTest[] Collection of the Tests
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

    /**
     * Sets Factory
     * @param AbTestFactoryInterface $factory
     * @return $this
     */
    public function setFactory(AbTestFactoryInterface $factory)
    {
        $this->abTestFactory = $factory;
        
        return $this;
    }

    /**
     * Instantiates and adds test into tests array
     * @param                 $name
     * @param CBaseController $owner
     * @param bool            $isTrialMode
     * @return PhpabTest
     */
    public function addTest($name, CBaseController $owner, $isTrialMode = PhpabTest::MODE_TRIAL)
    {
        $test = new PhpabTest($name, $owner, $isTrialMode);
        $this->tests[$name] = $test;

        return $test;
    }

    /**
     * Executes All the tests from the collection
     */
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
