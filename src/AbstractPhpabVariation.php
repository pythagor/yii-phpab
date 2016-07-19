<?php

namespace pythagor\yiiphpab;

use CBaseController;

/**
 * Class AbstractPhpabVariation
 * Represents A/B Test variation
 * @package pythagor\yiiphpab
 * @author  Andrei Chugunov <admin@pythagor.com>
 */
abstract class AbstractPhpabVariation
{
    /**
     * @var string Variation name
     */
    protected $name;

    /**
     * @var string Render view name
     */
    protected $view;

    /**
     * @var array Render view parameters
     */
    protected $params = [];

    /**
     * @var string Rendered view
     */
    protected $value;

    /**
     * PhpabVariation constructor.
     * @param string $name
     * @param string $view
     * @param array  $params
     */
    public function __construct($name, $view, array $params = [])
    {
        $this->name = $name;
        $this->view = $view;
        $this->params = $params;
    }

    abstract public function renderValue(CBaseController $owner);
}
