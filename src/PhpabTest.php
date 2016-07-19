<?php

namespace pythagor\yiiphpab;

/**
 * Class PhpabTest
 * Represents A/B Test
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
class PhpabTest extends AbstractPhpabTest
{
    /**
     * Gets value of the Variation given and adds the Variation into Collection
     * @param AbstractPhpabVariation $variation
     * @return $this
     */
    public function addVariation(AbstractPhpabVariation $variation)
    {
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
}
