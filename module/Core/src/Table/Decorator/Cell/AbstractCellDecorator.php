<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Cell;

use Core\Table\Decorator\AbstractDecorator;
use Core\Table\Decorator\DataAccessInterface;

abstract class AbstractCellDecorator extends AbstractDecorator implements DataAccessInterface
{

    /**
     * Get cell object
     * @var \Core\Table\Cell
     */
    protected $cell;

    /**
     *
     * @return \Core\Table\Cell
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     *
     * @param \Core\Table\Cell $cell
     * @return $this
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
        return $this;
    }


    /**
     * Actual row data
     *
     * @return array
     */
    public function getActualRow()
    {
        return $this->getCell()->getActualRow();
    }
}
