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

    public function compromissosAction(){
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
        $this->template = sprintf("agenda/evento/%s/add-event", LAYOUT);
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
            $this->form->get('categorie_id')->setValue($data['categorieId']);
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
        $this->template = sprintf("agenda/evento/%s/update-event", LAYOUT);
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