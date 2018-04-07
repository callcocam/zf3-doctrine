<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/04/2018
 * Time: 15:52
 */

namespace Api\Controller;


use Interop\Container\ContainerInterface;

class PostController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "adm-blog";
        $this->controller = "post";
        $this->container = $container;
        $this->service = 'Blog\Service\PostService';
        $this->filter = 'Blog\Filter\PostFilter';
        $this->setServiceManager('Api\Table\PostTable', $this->factoryTable);
        $this->setEntity('Blog\Entity\PostEntity')->setTable('Api\Table\PostTable');
    }

}