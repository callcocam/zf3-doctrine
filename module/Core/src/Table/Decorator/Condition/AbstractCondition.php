<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Condition;

use Core\Table\Decorator\AbstractDecorator;
use Core\Table\Decorator\DataAccessInterface;

abstract class AbstractCondition implements ConditionInterface
{

    /**
     * Decorator
     * @var AbstractDecorator
     */
    protected $decorator;

    /**
     * Get decorator
     * @return AbstractDecorator
     */
    public function getDecorator()
    {
        return $this->decorator;
    }

    /**
     * Set decorator
     *
     * @param DataAccessInterface $decorator
     * @return $this
     */
    public function setDecorator($decorator)
    {
        $this->decorator = $decorator;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getActulRow()
    {
        return $this->decorator->getActualRow();
    }
}
