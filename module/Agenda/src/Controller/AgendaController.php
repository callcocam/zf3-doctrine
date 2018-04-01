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

class AgendaController extends AbstractController
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
        $this->controller = "agenda";
        $this->template = sprintf("agenda/agenda/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Agenda\Service\AgendaService';
        $this->form = 'Agenda\Form\AgendaForm';
        $this->filter = 'Agenda\Filter\AgendaFilter';
        $this->setServiceManager('Agenda\Table\AgendaTable', $this->factoryTable);
        $this->setEntity('Agenda\Entity\AgendaEntity')->setTable('Agenda\Table\AgendaTable');
    }

    public function agendaAction()
    {
        $this->setServiceManager('Agenda\Table\CalendarTable', $this->factoryTable)
            ->setTable('Agenda\Table\CalendarTable');
        $data = $this->dataTableJson();
        $view = new ViewModel();
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        $view->setVariable('data', $data);
        return $view;
    }

    public function addAction()
    {
        $this->form = 'Agenda\Form\AddForm';
        $data = $this->params()->fromPost();
        if ($data):
            if (!$this->identity()):
                return $this->restrict();
            endif;
        else:
            if (!$this->identity()):
                return $this->auth();
            endif;
        endif;
        if (is_string($this->form)):
            $this->getForm();
        endif;
        $this->form->get('start')->setValue($data['start']);
        $this->form->get('end')->setValue($data['end']);
        $view = new ViewModel();
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        $view->setVariable('data', $data);

        $view->setVariable('form', $this->form);
        return $view;
    }

    public function addeventAction()
    {
        $this->form = 'Agenda\Form\AddForm';
        $this->template = sprintf("agenda/agenda/%s/add-event", LAYOUT);
        return parent::saveAction();
    }

    public function updateAction()
    {
        $data=$this->params()->fromPost();
        if ($data):
            if (!$this->identity()):
                return $this->restrict();
            endif;
        else:
            if (!$this->identity()):
                return $this->auth();
            endif;
        endif;
         if (is_string($this->form)):
            $this->getForm();
        endif;
        $id = $this->params()->fromRoute("id", 0);
        if ((int)$id) {
            $data = $this->repository->find($id);
            $this->form->setData($this->extracted($data->toArray()));
        } else {
            $this->form->get('event_id')->setValue($data['eventId']);
            $this->form->get('description')->setValue($data['description']);
            $this->form->get('title')->setValue($data['title']);
            $this->form->get('start')->setValue($data['start']);
            $this->form->get('end')->setValue($data['end']);
        }
        $view = new ViewModel();
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        $view->setVariable('form', $this->form);
        return $view;
    }

    public function updateeventAction()
    {
        $this->template = sprintf("agenda/agenda/%s/update-event", LAYOUT);
        return parent::saveAction();
    }

    public function listeventAction()
    {
        $this->setServiceManager('Agenda\Table\CalendarTable', $this->factoryTable)
            ->setTable('Agenda\Table\CalendarTable');
        $data = $this->dataTableJson();
        $view = new JsonModel($data['sEcho']);
        return $view;
    }
}