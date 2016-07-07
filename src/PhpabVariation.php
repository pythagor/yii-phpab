<?php

namespace pythagor\yiiphpab;

use CWidget;
use CBaseController;

class PhpabVariation
{
    private $name;
    private $view;
    private $params = [];
    private $value;

    public function __construct($name, $view, array $params = [])
    {
        $this->name = $name;
        $this->view = $view;
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

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
