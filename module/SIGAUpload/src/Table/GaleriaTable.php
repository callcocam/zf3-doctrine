<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace SIGAUpload\Table;


use Core\Table\AbstractTable;
use Core\Table\Table\ActionsConfig;
use Core\Table\Table\ButtonsConfig;
use Core\Table\Table\Config;
use Core\Table\Table\HeadersConfig;
use Core\Table\Table\ImgConfig;
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Doctrine\ORM\QueryBuilder;
use Interop\Container\ContainerInterface;

class GaleriaTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->getActions();
        $this->headers = (new HeadersConfig())
            ->add('name',['tableAlias' => 'p','title' => 'Name'],'id')
            ->add('cover',['tableAlias' => 'p','title' => 'Cover', 'width' => '100',"sortable"=>false,],'name')
            ->add('cover_height',['tableAlias' => 'p','title' => 'cover_height'],'cover')
            ->add('cover_width',['tableAlias' => 'p','title' => 'cover_width'],'cover')
            ->add('cover_quality',['tableAlias' => 'p','title' => 'cover_quality'],'cover_width')
            ->add('tipo',['tableAlias' => 'p','title' => 'tipo'],'cover_quality')
            ->add('assets',['tableAlias' => 'p','title' => 'assets'],'tipo')
            ->add('path',['tableAlias' => 'p','title' => 'path'],'assets')
            ->add('parent',['tableAlias' => 'p','title' => 'parent'],'assets')
            ->getHeaders();

        $this->config = (new Config())->add('itemCountPerPage', '40')->add('name','Lista de makes')->getConfigs();

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