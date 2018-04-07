<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class CategorieBlogController extends AbstractController
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
        $this->controller = "categorie-blog";
        $this->template = sprintf("blog/categorie-blog/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Blog\Service\CategorieBlogService';
        $this->form = 'Blog\Form\CategorieBlogForm';
        $this->filter = 'Blog\Filter\CategorieBlogFilter';
        $this->setServiceManager('Blog\Table\CategorieBlogTable', $this->factoryTable);
        $this->setEntity('Blog\Entity\CategorieBlogEntity')->setTable('Blog\Table\CategorieBlogTable');
    }
}