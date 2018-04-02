<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Agenda\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

class CategorieController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "adm-agenda";
        $this->controller = "categorie";
        $this->template = sprintf("agenda/categorie/%s/editar-form", LAYOUT);
        $this->templateCuston = 'custom';
        $this->templateList = sprintf('layout/%s/templates/agenda-event', LAYOUT);
        $this->container = $container;
        $this->service = 'Agenda\Service\CategorieService';
        $this->form = 'Agenda\Form\CategorieForm';
        $this->filter = 'Agenda\Filter\CategorieFilter';
        $this->setServiceManager('Agenda\Table\CategorieTable', $this->factoryTable);
        $this->setEntity('Agenda\Entity\CategorieEntity')->setTable('Agenda\Table\CategorieTable');
    }


    public function listarAction()
    {
        $this->setServiceManager('Agenda\Table\CategorieAjaxTable', $this->factoryTable)
            ->setTable('Agenda\Table\CategorieAjaxTable');
        return parent::listarAction();
    }


    public function addAction()
    {
        if (!$this->identity()):
            return $this->restrict();
        endif;
        $id = $this->params()->fromRoute("id", 0);
        if (is_string($this->form)):
            $this->getForm();
        endif;
        $view = new ViewModel($this->args);
        $view->setTerminal(true);
        $view->setVariable('id', $id);
        $view->setVariable('form', $this->form);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }

    public function addeventAction()
    {
        $this->template = sprintf("agenda/evento/%s/add-event", LAYOUT);
        return parent::saveAction();
    }
}