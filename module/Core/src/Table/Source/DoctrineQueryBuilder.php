<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Source;

use Zend\Debug\Debug;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class DoctrineQueryBuilder extends AbstractSource
{

    /**
     *
     * @var \Doctrine\ORM\QueryBuilder
     */
    protected $query;

    /**
     *
     * @var  \Zend\Paginator\Paginator
     */
    protected $paginator;

    /**
     *
     * @param \Doctrine\ORM\QueryBuilder $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     *
     * @return \Zend\Paginator\Paginator
     */
    public function getPaginator()
    {
        if (!$this->paginator) {


            $this->order();
            $this->quickSearch();
            $adapter = new DoctrineAdapter(new ORMPaginator($this->query));
            $this->paginator = new Paginator($adapter);
            $this->initPaginator();
            //Debug::dump($this->query->getQuery()->getSQL());
        }
        return $this->paginator;
    }



    protected function order()
    {
        $column = $this->getParamAdapter()->getColumn();
        $order = $this->getParamAdapter()->getOrder();

        if (!$column) {
            return;
        }
        $header = $this->getTable()->getHeader($column);
        $tableAlias = ($header) ? $header->getTableAlias() : 'q';
        if (false === strpos($tableAlias, '.')) {
            $tableAlias = $tableAlias.'.'.$column;
        }

        $this->query->orderBy($tableAlias, $order);
    }

    /*
         * Init quick search
         */
    protected function quickSearch()
    {
        $concatFields = array_keys($this->getTable()->getHeaders());
        $anyKeyword = $this->getParamAdapter()->getQuickSearch();
        $And =true;
        // consulta pelos campos.
        if(!empty($anyKeyword)):
            foreach ($concatFields as $field) {
                $header = $this->getTable()->getHeader($field);
                $tableAlias = ($header) ? $header->getTableAlias() : 'q';
                if($And):
                    $this->query->andWhere("{$tableAlias}.{$field} LIKE :searchTerm");
                    $And = false;
                else:
                    $this->query->orWhere("{$tableAlias}.{$field} LIKE :searchTerm");
                endif;
            }
            $this->query->setParameter('searchTerm', "%{$anyKeyword}%");
        endif;
        //Verifica pelo status
        if(!empty($this->getParamAdapter()->getStatus())):
            $header = $this->getTable()->getHeader('status');
            $tableAlias = ($header) ? $header->getTableAlias() : 'q';
            $this->query->andWhere("{$tableAlias}.status  = :enabled");
            $this->query ->setParameter('enabled', $this->getParamAdapter()->getStatus());
        endif;
        //consulta pela data
        if(!empty($this->getParamAdapter()->getStartDate()) && !empty($this->getParamAdapter()->getEndDate())):
            $header = $this->getTable()->getHeader('createdAt');
            $tableAlias = ($header) ? $header->getTableAlias() : 'q';
            $this->query->andWhere("{$tableAlias}.createdAt BETWEEN :from AND :to")
                ->setParameter('from', $this->getParamAdapter()->getStartDate() )
                ->setParameter('to', $this->getParamAdapter()->getEndDate());
        endif;

    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getSource()
    {
        return $this->query;
    }
}
