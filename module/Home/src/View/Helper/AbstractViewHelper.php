<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/04/2018
 * Time: 22:34
 */

namespace Home\View\Helper;


use Core\Entity\AbstractEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Helper\AbstractHelper;

use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

abstract class AbstractViewHelper extends AbstractHelper
{
    protected $container;
    /**
     * @var EntityManager
     */
    protected $em;
    protected $table;
    /**
     * @var QueryBuilder
     */
    protected $Select;
    protected $Data;
    protected $Result;
    protected $order = [
        'key' => 'id',
        'value' => 'DESC'
    ];
    protected $Values;
    protected $Keys;
    protected $Title = "Banners";
    /**
     * @var Paginator
     */
    protected $paginator;
    protected $itemCountPerPage = 100;
    protected $status = 1;
    protected $tableAlias = "q";
    protected $startDate;
    protected $endDate;


    /**
     * AbstractViewHelper constructor.
     * @param ContainerInterface $container
     */
    abstract function __construct( ContainerInterface $container );

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * @param mixed $Data
     * @return AbstractViewHelper
     */
    public function setData( $Data )
    {
        $this->Data = $Data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * @param mixed $Result
     * @return AbstractViewHelper
     */
    public function setResult( $Result )
    {
        $this->Result = $Result;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrder($key)
    {
        return $this->order[$key];
    }

    /**
     * @param array $order
     * @return AbstractViewHelper
     */
    public function setOrder( array $order ): AbstractViewHelper
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     * @return AbstractViewHelper
     */
    public function setTitle( string $Title ): AbstractViewHelper
    {
        $this->Title = $Title;
        return $this;
    }

    /*
     * ***************************************
     * **********  PROTECTED METHODS  **********
     * ***************************************
     */
    public function getPaginator()
    {
        if (!$this->paginator) {
            $this->quickSearch();
            $this->quickOrder();
            $adapter = new DoctrineAdapter(new ORMPaginator($this->Select));
            $this->paginator = new Paginator($adapter);
            $this->initPaginator();
          // Debug::dump($this->Select->getQuery()->getSQL());
        }
        return $this->paginator;
    }

    /**
     * Init paginator
     */
    protected function initPaginator()
    {
        $this->paginator->setItemCountPerPage($this->getItemCountPerPage());
        $this->paginator->setCurrentPageNumber($this->getPage());
    }

    /**
     * @param mixed $endDate
     * @return AbstractViewHelper
     */
    public function setEndDate( $endDate )
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @param mixed $startDate
     * @return AbstractViewHelper
     */
    public function setStartDate( $startDate )
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     *
     */
    protected function quickOrder()
    {
        $this->Select->orderBy($this->getTableAlias().'.'.$this->getOrder('key'),$this->getOrder('value'));
    }

    /*
         * Init quick search
         */
    protected function quickSearch()
    {
        $slug = $this->view->Route()->getParan("searchTerm");
        $anyKeyword = $this->view->Route()->getQueryParams("searchTerm");
        $tableAlias = $this->getTableAlias();
        $And = true;
        if (empty($slug)):
            // consulta pelos campos.
            if (!empty($anyKeyword)):
                $concatFields = $this->getHeaders();
                foreach ($concatFields as $field) {
                    if ($And):
                        $this->Select->andWhere("{$tableAlias}.{$field} LIKE :searchTerm");
                        $And = false;
                    else:
                        $this->Select->orWhere("{$tableAlias}.{$field} LIKE :searchTerm");
                    endif;
                }
                $this->Select->setParameter('searchTerm', "%{$anyKeyword}%");
            endif;
            //Verifica pelo status
            if (!$this->getStatus()):
                $this->Select->andWhere("{$tableAlias}.status  = :enabled");
                $this->Select->setParameter('enabled', $this->getStatus());
            endif;
            //consulta pela data
            if (!empty($this->getStartDate()) && !empty($this->getEndDate())):
                $this->Select->andWhere("{$tableAlias}.createdAt BETWEEN :from AND :to")
                    ->setParameter('from', $this->getStartDate())
                    ->setParameter('to', $this->getEndDate());
            endif;
        else:
            $this->Select->expr()->eq("p.alias", ":slug");
            $this->Select->setParameter(":slug", $slug);
        endif;

    }

    protected function extracted( $data )
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \Datetime):
                $data[$key] = $value->format("d/m/Y H:i:s");
            else:
                if ($value instanceof AbstractEntity) {
                    $value = $this->extracted($value->toArray());
                }
                $data[$key] = $value;
            endif;
        }
        return $data;
    }

    /**
     * @return mixed
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     * @return AbstractViewHelper
     */
    protected function setContainer( $container )
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getEm()
    {
        $this->em = $this->container->get("Doctrine\ORM\EntityManager");
        return $this->em;
    }

    /**
     * @return mixed
     */
    protected function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     * @return AbstractViewHelper
     */
    protected function setTable( $table )
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getSelect()
    {
        return $this->Select;
    }

    /**
     * @param mixed $Select
     * @return AbstractViewHelper
     */
    protected function setSelect( $Select )
    {
        $this->Select = $Select;
        return $this;
    }


    //Executa o tratamento dos campos para substituição de chaves na view.
    protected function setKeys( $Data )
    {
        $this->Keys = explode('&', '{' . implode("}&{", array_keys($Data)) . '}');
    }

    //Obtém os valores a serem inseridos nas chaves da view.
    protected function setValues( $Data )
    {
        $this->Values = array_values($Data);
    }

    protected function getPage()
    {
        $page = $this->view->Route()->getQueryParams("page", 1);
        return $page;

    }

    /**
     * @return mixed
     */
    protected function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    protected function getHeaders()
    {

        return ['name'];

    }

    /**
     * @return mixed
     */
    protected function getStatus()
    {
        return $this->status;
    }

    /**
     *
     */
    protected function getTableAlias()
    {

        return $this->tableAlias;

    }

    /**
     * @return mixed
     */
    protected function getStartDate()
    {
        return $this->startDate;
    }

    /**
     *
     */
    protected function getEndDate()
    {
        return $this->endDate;
    }

}