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
use Core\Table\Table\ItemPerPageConfig;
use Core\Table\Table\StatusConfig;
use Interop\Container\ContainerInterface;

class ConfigTable extends AbstractTable
{


    public function __construct(ContainerInterface $container)
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->add('config',[
            'config'=>[
                "label" => "Gerar Configurações",
                "attrs"=>[
                    "class"=> "bg-olive",
                    "id" =>"",
                    "href" =>"",
                ],
                "action" =>"dotenv",
                "ico" =>"fa fa-question-circle",
                "state"=>[1]
            ]
        ])->getActions();

        $this->headers = (new HeadersConfig())
            ->add('confName',['tableAlias' => 'p','title' => 'Nome Da Configuração'],'id')
            ->add('confValue',['tableAlias' => 'p','title' => 'Valor Da Configuração'],'confName')
            ->add('confType',['tableAlias' => 'p','title' => 'Tipo Da Configuração'],'confValue')
            ->getHeaders();


        $this->config = (new Config())->add('name','Lista de configurações')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();

        $this->valuesOfItemPerPage = (new ItemPerPageConfig())->add(200,200)->getItems();



    }

    public function init()
    {
        $this->buttonConfig = new ButtonsConfig($this->getRoute(), $this->getController());
        $this->buttonConfig->setParams($this->getRouteHelper()->getParans());

//        $this->getHeader('cover')->getCell()->addDecorator('img', [
//            (new ImgConfig())
//                ->setRoute($this->getRoute())
//                ->setController($this->getController())
//                ->add()
//        ]);

        $this->getHeader('confName')->getCell()->addDecorator('link', [
            'url' =>  $this->getUrl(sprintf('%s/default', $this->Route), [
                'controller'=> $this->Controller,
                'action'=>'create',
                'id' => "%s"
            ]),
            'vars' => ['id'],
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
            ->add("editar")
            ->setLink($this->url);

        $this->buttonConfig->setName("excluir")
            ->setIcone('fa fa-trash')
            ->setAttrs([
                'class'=>'btn btn-danger btn-xs btn-flat j_confirm_delete',
                'data-state' => '%s'
            ])
            ->setStatus([1,2,3])
            ->add("excluir")
            ->setLink($this->url,"action","id");


        $this->getHeader('status')->getCell()->addDecorator('btn', [
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