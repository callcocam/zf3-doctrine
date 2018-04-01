<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class EventoController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-agenda";
        $this->controller = "evento";
        $this->template = sprintf("agenda/evento/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Agenda\Service\EventoService';
        $this->form = 'Agenda\Form\EventoForm';
        $this->filter = 'Agenda\Filter\EventoFilter';
        $this->setServiceManager('Agenda\Table\EventoTable', $this->factoryTable);
        $this->setEntity('Agenda\Entity\EventoEntity')->setTable('Agenda\Table\EventoTable');
    }

    public function listeventAction(){
        if (!$this->identity()):
            return $this->auth();
        endif;
        $this->setServiceManager('Agenda\Table\EvTable', $this->factoryTable)
            ->setTable('Agenda\Table\EvTable');
        //I don't know if it necesary to validate that request is POST
        $queryBuilder = $this->repository->createQueryBuilder("p");
        $this->table->setSource($queryBuilder)
            ->setRoute($this->getRoute($this->route))
            ->setController($this->controller)
            ->setParamAdapter($this->getRequest()->getPost());
         $view = $this->table->render('custom',sprintf('layout/%s/templates/agenda-event', LAYOUT));
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
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