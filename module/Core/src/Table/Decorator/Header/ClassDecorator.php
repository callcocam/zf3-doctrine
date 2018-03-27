<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Header;

use Core\Table\Decorator\Cell\AbstractCellDecorator;

class ClassDecorator extends AbstractCellDecorator
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
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        if (count($this->class) > 0 && is_array($this->class)) {
            foreach ($this->class as $class) {
                $this->getCell()->addClass($class);
            }
        }
        return $context;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = (is_array($class)) ? $class : explode(' ', $class);
        return $this;
    }

    /**
     * Get class
     *
     * @return null|array
     */
    public function getClass()
    {
        return $this->class;
    }
}
