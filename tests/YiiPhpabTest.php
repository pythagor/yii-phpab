<?php

namespace pythagor\yiiphpab\tests;

use CTestCase;
use pythagor\yiiphpab\PhpabVariation;
use Yii;
use pythagor\yiiphpab\YiiPhpab;
use pythagor\yiiphpab\PhpabTest;
use CController;

class YiiPhpabTest extends CTestCase
{
    const TEST_NAME = 'test_name';

    private $controller;

    /**
     * @var YiiPhpab
     */
    private $extension;

    public function setUp()
    {
        parent::setUp();
        $this->controller = $this
            ->getMockBuilder(CController::class)
            ->setConstructorArgs([
                'test',
            ])
            ->getMock();
        Yii::app()->controller = $this->controller;
        $this->extension = Yii::app()->YiiPhpab;
        $this->extension->setFactory(new AbTestFactoryTest($this));
    }

    public function testExtension()
    {
        static::assertInstanceOf(YiiPhpab::class, $this->extension);
        static::assertAttributeInstanceOf(AbTestFactoryTest::class, 'abTestFactory', $this->extension);
    }

    public function testAddTest()
    {
        static::assertAttributeCount(0, 'tests', $this->extension);
        $test = $this->extension->addTest(
            new PhpabTest(
                self::TEST_NAME,
                $this->controller
            )
        );
        static::assertInstanceOf(PhpabTest::class, $test);
        static::assertAttributeCount(1, 'tests', $this->extension);
    }

    // @todo not finished
    public function testRunTest()
    {
        $test = $this->extension->addTest(
            new PhpabTest(
                self::TEST_NAME,
                $this->controller
            )
        );
        $test->addVariation(
            new PhpabVariation(
                PhpabTestTest::VARIATION_NAME,
                PhpabTestTest::TEST_VIEW
            )
        );
        $this->extension->runTest();
    }
}
