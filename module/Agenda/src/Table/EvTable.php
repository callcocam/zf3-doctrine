<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Table;


use Core\Table\AbstractTable;
use Core\Table\Table\ActionsConfig;
use Core\Table\Table\ButtonsConfig;
use Core\Table\Table\Config;
use Core\Table\Table\HeadersConfig;
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Interop\Container\ContainerInterface;

class EvTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->getActions();
        $this->headers = (new HeadersConfig())
            ->add('title',['tableAlias' => 'p','title' => 'Name'],'id')
            ->add('className',['tableAlias' => 'p','title' => 'Name'],'id')
            ->add('description',['tableAlias' => 'p','title' => 'Name'],'id')
            ->getHeaders();

        $this->config = (new Config())->add('name','Lista de makes')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();

        $this->valuesOfItemPerPage = (new ItemPerPageConfig())->add(10,10)->getItems();
        //Descomente para imagem
        //$this->coverConfig = new ImgConfig();



    }

    public function init()
    {

    }

    //The filters could also be done with a parametrised query
    protected function initFilters($query)
    {

    }
}