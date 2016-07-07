<?php

namespace pythagor\yiiphpab\tests;

use phpab;
use pythagor\yiiphpab\AbTestFactoryInterface;
use pythagor\yiiphpab\PhpabTest;

class AbTestFactoryTest implements AbTestFactoryInterface
{
    private $ownerTest;

    public function __construct(YiiPhpabTest $phpabTest)
    {
        $this->ownerTest = $phpabTest;
    }

    /**
     * @param      $name
     * @param bool $isTrialMode
     * @return phpab
     */
    public function getAbTestInstance($name, $isTrialMode = PhpabTest::MODE_TRIAL)
    {
        $mock = $this->ownerTest->getMockBuilder(phpab::class)
            ->setConstructorArgs([
                $name,
                $isTrialMode,
            ])
            ->setMethods([
                '__destruct',
            ])
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }
}
