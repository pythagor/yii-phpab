<?php

namespace pythagor\yiiphpab;

use CBaseController;

class PhpabTest
{
    const MODE_TRIAL = true;
    const MODE_PRODUCTION = false;

    /**
     * @var PhpabVariation[]
     */
    private $variations = [];

    private $name;

    /**
     * @var  CBaseController
     */
    private $owner;

    private $isTrialMode = true;

    public function __construct($name, CBaseController $owner, $isTrialMode = self::MODE_TRIAL)
    {
        $this->name = $name;
        $this->isTrialMode = $isTrialMode;
        $this->owner = $owner;
    }

    public function addVariation($name, $view, array $params = [])
    {
        $variation = new PhpabVariation($name, $view, $params);
        $variation->renderValue($this->owner);
        $this->variations[] = $variation;

        return $this;
    }

    public function renderVariations()
    {
        $text = '{phpab ' . $this->name . '}';
        $defaultVariation = array_shift($this->variations);
        $text .= $defaultVariation->getValue();
        $text .= '{/phpab ' . $this->name . '}';

        return $text;
    }

    public function getVariations()
    {
        return $this->variations;
    }

    public function getIsTrialMode()
    {
        return $this->isTrialMode;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
