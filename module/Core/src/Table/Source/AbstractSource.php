<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Source;

use Core\Table\AbstractCommon;
use Core\Table\Params\AdapterInterface;
use Core\Table\Source\SourceInterface;
use Zend\Paginator\Paginator;

abstract class AbstractSource extends AbstractCommon implements SourceInterface
{

    /**
     *
     * @var \Core\Table\Params\AdapterInterface
     */
    protected $paramAdapter;


    abstract protected function order();

    /**
     * @return \Core\Table\Params\AdapterInterface
     */
    public function getParamAdapter()
    {
        if (!$this->paramAdapter) {
            $this->paramAdapter = $this->getTable()->getParamAdapter();
        }
        return $this->paramAdapter;
    }

    /**
     *
     * @return Paginator
     */
    public function getData()
    {
        $paginator = $this->getPaginator();
        return $paginator;
    }


    /**
     * Init query like ordering and quick searching
     */
    protected function initQuery()
    {
        $this->order();
        $this->quickSearch();
    }

    /**
     * Init paginator
     */
    protected function initPaginator()
    {
        $this->paginator->setItemCountPerPage($this->getParamAdapter()->getItemCountPerPage());
        $this->paginator->setCurrentPageNumber($this->getParamAdapter()->getPage());
    }

    /**
     *
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     *
     * @param AdapterInterface $paramAdapter
     */
    public function setParamAdapter(AdapterInterface $paramAdapter)
    {
        $this->paramAdapter = $paramAdapter;
    }
}
