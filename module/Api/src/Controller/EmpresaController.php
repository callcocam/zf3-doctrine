<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/04/2018
 * Time: 14:50
 */

namespace Api\Controller;


use Interop\Container\ContainerInterface;

class EmpresaController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "api-empresa";
        $this->controller = "empresa";
        $this->container = $container;
        $this->service = 'Admin\Service\EmpresaService';
        $this->filter = 'Admin\Filter\EmpresaFilter';
        $this->setServiceManager('Api\Table\EmpresaTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\EmpresaEntity')->setTable('Api\Table\EmpresaTable');
    }


}