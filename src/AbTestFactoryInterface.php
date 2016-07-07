<?php

namespace pythagor\yiiphpab;

interface AbTestFactoryInterface
{
    public function getAbTestInstance($name, $isTrialMode = PhpabTest::MODE_TRIAL);
}
