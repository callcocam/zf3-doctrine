<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Api\Table;


use Core\Table\AbstractTable;
use Core\Table\Table\ActionsConfig;
use Core\Table\Table\ButtonsConfig;
use Core\Table\Table\Config;
use Core\Table\Table\HeadersConfig;
use Core\Table\Table\ImgConfig;
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Interop\Container\ContainerInterface;

class EmpresaTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->getActions();
        $this->headers = (new HeadersConfig())
            ->add('cover',['tableAlias' => 'p','title' => 'Cover', 'width' => '100',"sortable"=>false,],'id')
            ->add('fantasia',['tableAlias' => 'p','title' => 'Name'],'cover')
            ->add('action',['tableAlias' => 'p','title' => '#', 'width' => '100',"sortable"=>false,],'status')
            ->getHeaders();

        $this->config = (new Config())->add('name','Lista de makes')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();

        $this->valuesOfItemPerPage = (new ItemPerPageConfig())->add(2,2)->getItems();

        $this->coverConfig = new ImgConfig();

    }

    public function init()
    {

    }

    //The filters could also be done with a parametrised query
    protected function initFilters($query)
    {

    }
}