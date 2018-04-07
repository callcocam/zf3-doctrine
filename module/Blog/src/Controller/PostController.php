<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class PostController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-blog";
        $this->controller = "post";
        $this->template = sprintf("blog/post/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Blog\Service\PostService';
        $this->form = 'Blog\Form\PostForm';
        $this->filter = 'Blog\Filter\PostFilter';
        $this->setServiceManager('Blog\Table\PostTable', $this->factoryTable);
        $this->setEntity('Blog\Entity\PostEntity')->setTable('Blog\Table\PostTable');
    }
}