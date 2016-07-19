<?php

namespace pythagor\yiiphpab;

use CBaseController;

/**
 * Class AbstractPhpabTest
 * Represents A/B Test
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
abstract class AbstractPhpabTest
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
    protected $variations = [];

    /**
     * @var string Name of the Test
     */
    protected $name;

    /**
     * @var CBaseController Component where the Test from
     */
    protected $owner;

    /**
     * @var bool Mode for the current Test
     */
    protected $isTrialMode = true;

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

    abstract public function addVariation(AbstractPhpabVariation $variation);

    abstract public function renderVariations();

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
