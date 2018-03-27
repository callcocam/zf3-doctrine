<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Make\Controller;


use Make\Code\Generate;
use Make\Filter\GerarFilter;
use Make\Filter\MakeFilter;
use Make\Form\GerarForm;
use Make\Form\MakeForm;
use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Make\Entity\MakeEntity;
use Make\Service\MakeService;
use Make\Table\MakeTable;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;

class CreateController extends AbstractController
{

    protected $aFind = [];
    protected $aSub = [];
    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-make";
        $this->controller = "create";
        $this->template = sprintf("make/%s/%s/editar-form", $this->controller,LAYOUT);
        $this->container = $container;
        $this->service = MakeService::class;
        $this->form = MakeForm::class;
        $this->filter = MakeFilter::class;
        $this->setServiceManager(MakeTable::class, $this->factoryTable);
        $this->setEntity(MakeEntity::class)->setTable(MakeTable::class);
    }

    public function gerarAction()
    {
        $this->form = GerarForm::class;
        $this->filter = GerarFilter::class;
        $id = $this->params()->fromRoute("id", 0);
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if ($id) {
            $data = $this->repository->find($id);
            if (!$data) {
                return $this->redirect()->toRoute(sprintf("%s/default", $this->getRoute($this->route)));
            }
            $this->form->setData($this->extracted($data->toArray()));
        }
        $view = new ViewModel($this->args);
        $view->setVariable('form', $this->form);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }

    public function gerarformAction()
    {
        $this->form = GerarForm::class;
        $this->filter = GerarFilter::class;
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if (is_string($this->filter)):
            $this->getFilter();
        endif;

        if ($this->params()->fromPost()):
            $this->data = $this->params()->fromPost();
            $this->data['status'] = 1;
            $this->form->setData($this->data)->setInputFilter($this->filter->getInputFilter());
            if ($this->form->isValid()):
                $aFinSub =[
                   "S_Name" => ucfirst($this->data['controller']),
                   "S_Demo" => ucfirst($this->data['route']),
                   "S_route" =>$this->data['route'],
                   "S_controller" =>$this->data['controller'],
                ];
                $this->aFind = array_keys($aFinSub);
                $this->aSub = array_values($aFinSub);

                $generate = new Generate($this->data);
                $Msg = $generate->copiar_diretorio(sprintf("./module/%s", $this->data['alias']));
                $Alias = $this->repository->findBy(['alias'=>$this->data['alias'],'status'=>'1']);
                if($Alias){
                    $generate->generate_service_controller($Alias);
                }
                $this->addMessage($Msg, 'success');
            else:
                Debug::dump($this->form->getMessages());
            endif;
        endif;
        $view = new ViewModel($this->args);
        $view->setVariable('form', $this->form);
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }
}