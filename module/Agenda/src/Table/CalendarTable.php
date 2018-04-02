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

class CalendarTable extends AbstractTable
{


    public function __construct( ContainerInterface $container )
    {

        parent::__construct($container);

        $this->actions = (new ActionsConfig())->remove('csv')->getActions();
        $this->headers = (new HeadersConfig())
            ->add('title', ['tableAlias' => 'p', 'title' => 'Nome'], 'id')
            ->add('categorieId', ['tableAlias' => 'p', 'title' => 'event'], 'title')
            ->add('start', ['tableAlias' => 'p', 'title' => 'Inicio'], 'categorieId')
            ->add('end', ['tableAlias' => 'p', 'title' => 'Final'], 'start')
            ->add('className', ['tableAlias' => 'p', 'title' => 'Classe'], 'end')
            ->getHeaders();

        $this->config = (new Config())->add('itemCountPerPage', '100')->add('name', 'Lista de makes')->getConfigs();

        $this->valuesOfState = (new StatusConfig())->getStatus();
        //Descomente para imagem
        //$this->coverConfig = new ImgConfig();


    }

    public function init()
    {
        $this->buttonConfig = new ButtonsConfig();
        $this->getHeader('start')->getCell()->addDecorator('callable', array(
            'callable' => function ( $context, $record ) {
                return $context->format("Y-m-d H:i");
            }
        ));
        $this->getHeader('categorieId')->getCell()->addDecorator('callable', array(
            'callable' => function ( $context, $record ) {
                return $context->getId();
            }
        ));
        $this->getHeader('className')->getCell()->addDecorator('callable', array(
            'callable' => function ( $context, $record ) {
                return sprintf("bg-%s",$record->getCategorieId()->getClassName());
            }
        ));


        $this->getHeader('end')->getCell()->addDecorator('callable', array(
            'callable' => function ( $context, $record ) {
                return $context->format("Y-m-d H:i");
            }
        ));
    }

    //The filters could also be done with a parametrised query
    protected function initFilters( $query )
    {
        $query->andWhere("p.status  = :enabled");
        $query->setParameter('enabled', 1);
    }
}