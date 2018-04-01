<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Table;


use Core\Table\AbstractTable;
use Core\Table\Table\ActionsConfig;
use Core\Table\Table\ButtonsConfig;
use Core\Table\Table\Config;
use Core\Table\Table\HeadersConfig;
use Core\Table\Table\ImgConfig;
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Interop\Container\ContainerInterface;

class ConfigTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->getActions();
        $this->headers = (new HeadersConfig())
             ->add('confName',['tableAlias' => 'p','title' => 'Nome'],'id')
             ->add('confValue',['tableAlias' => 'p','title' => 'Valor'],'confName')
            ->add('action',['tableAlias' => 'p','title' => '#', 'width' => '100',"sortable"=>false,],'status')
            ->getHeaders();

        $this->config = (new Config())->add('name','Lista de makes')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();

        $this->valuesOfItemPerPage = (new ItemPerPageConfig())->add(2,2)->getItems();


    }

    public function init()
    {
        $this->buttonConfig = new ButtonsConfig();
        $this->getHeader('confName')->getCell()->addDecorator('link', [
            'action'=>'create',
            'vars' => 'id'
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

        $this->buttonConfig->setName("excluir")
            ->setStatus([1,2,3])
            ->add("excluir");

        $this->getHeader('action')->getCell()->addDecorator('btn', [
            'params' => $this->getRouteHelper()->getParans(),
            'url' => $this->buttonConfig,
        ]);

        //$this->getHeader('fantasia')->addClass('text-center');
    }

    //The filters could also be done with a parametrised query
    protected function initFilters($query)
    {

    }
}