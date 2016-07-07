<?php

namespace pythagor\yiiphpab\tests;

use CTestCase;
use CController;
use pythagor\yiiphpab\PhpabTest;
use pythagor\yiiphpab\PhpabVariation;

class PhpabTestTest extends CTestCase
{
    const TEST_VIEW = 'application.view';
    const VARIATION_NAME = 'variation_name';

    private $controller;

    public function setUp()
    {
        parent::setUp();
        $this->controller = new CController('test');
    }

    public function testAddVariation()
    {
        $test = new PhpabTest(YiiPhpabTest::TEST_NAME, $this->controller);
        static::assertCount(0, $test->getVariations());
        $test->addVariation(self::VARIATION_NAME, self::TEST_VIEW);
        static::assertCount(1, $test->getVariations());
        $variation = $test->getVariations()[0];
        static::assertInstanceOf(PhpabVariation::class, $variation);
        static::assertEquals($variation->getView(), self::TEST_VIEW);
        $viewText = file_get_contents(\Yii::getPathOfAlias(self::TEST_VIEW) . '.php');
        static::assertEquals($viewText, $variation->getValue());
    }

    public function testRenderVariations()
    {
        $test = new PhpabTest(YiiPhpabTest::TEST_NAME, $this->controller);
        $test->addVariation(self::VARIATION_NAME, self::TEST_VIEW);
        $text = $test->renderVariations();
        static::assertStringStartsWith('{phpab ' . $test->getName() . '}', $text);
        static::assertStringEndsWith('{/phpab ' . $test->getName() . '}', $text);
    }
}
