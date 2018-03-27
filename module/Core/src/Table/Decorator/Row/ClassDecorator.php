<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Row;

class ClassDecorator extends AbstractRowDecorator
{

    /**
     * Class
     * @var array
     */
    protected $class;

    public function __construct($options)
    {
        $this->setClass($options['class']);
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        if (count($this->class) > 0) {
            foreach ($this->class as $class) {
                $this->getRow()->addClass($class);
            }
        }
        return $context;
    }

    /**
     *
     * @param string|array $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = (is_array($class)) ? $class : explode(' ', $class);
        return $this;
    }

    /**
     *
     * @return null|array
     */
    public function getClass()
    {
        return $this->class;
    }
}
