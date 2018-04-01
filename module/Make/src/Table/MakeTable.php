<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 02:23
 */

namespace Make\Table;


use Core\Table\AbstractTable;
use Core\Table\Table\ActionsConfig;
use Core\Table\Table\ButtonsConfig;
use Core\Table\Table\Config;
use Core\Table\Table\HeadersConfig;
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;

class MakeTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);
        $this->container = $container;
        $this->actions = (new ActionsConfig())->remove('csv')->getActions();

        $this->headers = (new HeadersConfig())
            ->add('name',['tableAlias' => 'p','title' => 'Nome'],'id')
            ->add('route',['tableAlias' => 'p','title' => 'Route'],'name')
            ->add('alias',['tableAlias' => 'p','title' => 'Alias'],'route')
            ->getHeaders();

        $this->config = (new Config())->add('name','Lista de makes')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();

        $this->valuesOfItemPerPage = (new ItemPerPageConfig())->add(2,2)->getItems();



    }

    public function init()
    {
        $this->buttonConfig = new ButtonsConfig();

//        $this->getHeader('cover')->getCell()->addDecorator('img', [
//            (new ImgConfig())
//                ->setRoute($this->getRoute())
//                ->setController($this->getController())
//                ->add()
//        ]);

        $this->getHeader('name')->getCell()->addDecorator('link', [
            'action'=>'create',
            'vars' => 'id',
          //  'container'=>$this->container
        ]);
        $this->getHeader('id')->addDecorator('check');
        $this->getHeader('id')->getCell()->addDecorator('check');
        $this->getHeader('status')->getCell()->addDecorator('state', [
            'value' => [
                '1' => 'Active',
                '2' => 'Desactive',
                '3' => 'Trash',
            ],
            'class' => [
                '1' => 'green',
                '2' => 'yellow',
                '3' => 'red',
            ],
        ]);


        $this->buttonConfig->setName("editar")
            ->add("editar");

        $this->buttonConfig->setName("gerar")
            ->add("gerar");

        $this->buttonConfig->setName("excluir")
            ->setStatus([1,2,3])
            ->add("excluir");


        $this->getHeader('status')->getCell()->addDecorator('btn', [
            'url' => $this->buttonConfig
        ]);

        //$this->getHeader('fantasia')->addClass('text-center');
    }

    //The filters could also be done with a parametrised query
    protected function initFilters($query)
    {

    }
}