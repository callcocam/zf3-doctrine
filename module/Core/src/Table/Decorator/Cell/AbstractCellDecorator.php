<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Cell;

use Core\Table\Decorator\AbstractDecorator;
use Core\Table\Decorator\DataAccessInterface;
use Zend\View\Model\ViewModel;

abstract class AbstractCellDecorator extends AbstractDecorator implements DataAccessInterface
{

    /**
     * Get view
     * @var ViewModel
     */
    protected $view;
    /**
     * Get cell object
     * @var \Core\Table\Cell
     */
    protected $cell;

    /**
     * @return ViewModel
     */
    public function getView(): ViewModel
    {
        return $this->view;
    }

    /**
     * @param ViewModel $view
     * @return AbstractCellDecorator
     */
    public function setView( ViewModel $view ): AbstractCellDecorator
    {
        $this->view = $view;
        return $this;
    }


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
