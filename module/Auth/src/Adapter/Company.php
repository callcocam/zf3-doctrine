<?php

/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/12/2017
 * Time: 20:37
 */

namespace Auth\Adapter;

use Core\Table\AbstractTable;
use Zend\Db\Sql\Predicate\In;

class Company extends AbstractTable {

    protected $table = "empresa";
    protected $restrito = [];
    protected $Data;
    protected $EmpResult;

    public function matriz($id) {
        $this->EmpResult = $this->find($id);
        $this->restrito[$this->EmpResult['id']] = $id;
        if ($this->EmpResult):
            if ($this->EmpResult['tipo'] == "1"):
                $this->filiais($id);
            endif;
        endif;
        return $this->EmpResult;
    }

    public function filiais($id) {
        $this->getSelect()->where(new In('empresa', [$id]));
        //$this->Select->where(new IsNotNull('empresa'));
        $this->setStmt($this->getSql()->prepareStatementForSqlObject($this->Select));
        $this->exec();
        if ($this->getResultSet()->count()):
            $this->Data = $this->getResultSet()->toArray();
            $this->setRestrito($this->Data);
        endif;
        return $this->Data;
    }

    /**
     * @param $restrito
     *
     * @return $this
     */
    public function setRestrito($restrito) {
        foreach ($restrito as $item):
            $this->restrito[$item['id']] = $item['id'];
        endforeach;
        return $this;
    }

    /**
     * @return array
     */
    public function getRestrito(): array {
        return $this->restrito;
    }

    public function getData() {
        return $this->Data;
    }
    
    public function getEmpResult() {
        return $this->EmpResult;
    }

}
