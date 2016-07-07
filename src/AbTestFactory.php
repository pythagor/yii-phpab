<?php

namespace pythagor\yiiphpab;

use phpab;

class AbTestFactory implements AbTestFactoryInterface
{

    /**
     * @param      $name
     * @param bool $isTrialMode
     * @return phpab
     */
    public function getAbTestInstance($name, $isTrialMode = PhpabTest::MODE_TRIAL)
    {
        return new phpab($name, $isTrialMode);
    }
}
