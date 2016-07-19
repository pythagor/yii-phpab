<?php

namespace pythagor\yiiphpab;

use CWidget;
use CBaseController;

/**
 * Class PhpabVariation
 * Represents A/B Test variation
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
class PhpabVariation extends AbstractPhpabVariation
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Renders variation view
     * @param CBaseController $owner Controller or Widget where test from
     * @return $this
     */
    public function renderValue(CBaseController $owner)
    {
        $renderFunction = 'renderPartial';
        if ($owner instanceof CWidget) {
            $renderFunction = 'render';
        }
        $this->value = $owner->$renderFunction(
            $this->getView(),
            $this->getParams(),
            true
        );

        return $this;
    }
}
