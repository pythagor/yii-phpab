<?php

namespace pythagor\yiiphpab;

use CBaseController;

/**
 * Class PhpabTest
 * Represents A/B Test
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
class PhpabTest
{
    /**
     * Trial mode enabled
     */
    const MODE_TRIAL = true;

    /**
     * Trial mode disabled
     */
    const MODE_PRODUCTION = false;

    /**
     * @var PhpabVariation[] Collection of the Test Variations
     */
    private $variations = [];

    /**
     * @var string Name of the Test
     */
    private $name;

    /**
     * @var CBaseController Component where the Test from
     */
    private $owner;

    /**
     * @var bool Mode for the current Test
     */
    private $isTrialMode = true;

    /**
     * PhpabTest constructor.
     * @param string          $name
     * @param CBaseController $owner
     * @param bool            $isTrialMode
     */
    public function __construct($name, CBaseController $owner, $isTrialMode = self::MODE_TRIAL)
    {
        $this->name = $name;
        $this->isTrialMode = $isTrialMode;
        $this->owner = $owner;
    }

    /**
     * Instantiates Variation, Gets its value and adds Variation into Collection
     * @param string $name
     * @param string $view
     * @param array  $params
     * @return $this
     */
    public function addVariation($name, $view, array $params = [])
    {
        $variation = new PhpabVariation($name, $view, $params);
        $variation->renderValue($this->owner);
        $this->variations[] = $variation;

        return $this;
    }

    /**
     * Gets value of the first of the Variations in Collection and wraps it by the Test's tags
     * Should be used as placeholder of the variations output
     * @return string Default Variation wrapped by the Test's tags
     */
    public function renderVariations()
    {
        $text = '{phpab ' . $this->name . '}';
        $defaultVariation = array_shift($this->variations);
        $text .= $defaultVariation->getValue();
        $text .= '{/phpab ' . $this->name . '}';

        return $text;
    }

    /**
     * @return PhpabVariation[]
     */
    public function getVariations()
    {
        return $this->variations;
    }

    /**
     * @return bool
     */
    public function getIsTrialMode()
    {
        return $this->isTrialMode;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
