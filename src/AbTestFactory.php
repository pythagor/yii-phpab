<?php

namespace pythagor\yiiphpab;

use phpab;

/**
 * Class AbTestFactory
 * Made for instantiating phpab
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
class AbTestFactory implements AbTestFactoryInterface
{
    /**
     * Returns phpab instance
     * @param string $name
     * @param bool   $isTrialMode
     * @return phpab
     */
    public function getAbTestInstance($name, $isTrialMode = PhpabTest::MODE_TRIAL)
    {
        return new phpab($name, $isTrialMode);
    }
}
