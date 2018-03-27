<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Row;

use Core\Table\Decorator\AbstractDecorator;
use Core\Table\Decorator\DataAccessInterface;

abstract class AbstractRowDecorator extends AbstractDecorator implements DataAccessInterface
{

    /**
     * Row object
     * @var \Core\Table\Row
     */
    protected $row;

    /**
     *
     * @return \Core\Table\Row
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     *
     * @param \Core\Table\Row $row
     * @return $this
     */
    public function setRow($row)
    {
        $this->row = $row;
        return $this;
    }

    /**
     * Get actual row
     * @return array
     */
    public function getActualRow()
    {
        return $this->getRow()->getActualRow();
    }
}
