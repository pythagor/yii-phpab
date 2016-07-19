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
