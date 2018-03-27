<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Cell;

use Core\Table\Decorator\Exception;
use Core\Table\Table\Exception\InvalidArgumentException;

class Editable extends AbstractCellDecorator
{

    /**
     * Constructor
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct($options = array())
    {
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $cell = $this->getCell();
        $cell->addClass('editable');
        $cell->addAttr('data-column', $cell->getHeader()->getName());
        return $context;
    }
}
