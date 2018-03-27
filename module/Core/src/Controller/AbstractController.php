<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Core\Controller;

use Core\Entity\AbstractEntity;
use Core\Entity\AbstractRepository;
use Core\Filter\AbstractFilter;
use Core\Form\AbstractForm;
use Core\Image\ImagesUpload;
use Core\Service\AbstractService;
use Core\Service\Messages;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController
{

    /**
     * @var $container ContainerInterface
     */
    protected $container;
    protected $route = "admin";
    protected $controller = "admin";
    protected $action = "index";

    protected $factoryService = "Core\\Service\\Factory\\FactoryService";
    protected $factoryTable = "Core\\Table\\Factory\\FactoryTable";
    protected $factoryForm = "Core\\Form\\Factory\\FactoryForm";
    protected $factoryFilter = "Core\\Filter\\Factory\\FactoryFilter";
    /**
     * @var AuthManager $AuthManagerClass
     */
    protected $AuthManagerClass = "Admin\\Auth\\AuthManager";
    /**
     * @var UserManager $UserManagerClass
     */
    protected $UserManagerClass = "Admin\\Auth\\UserManager";

    /**
     * @var $table AbstractTable
     */
    protected $table;

    /**
     * @var $entity AbstractRepository
     */
    protected $entity;
    /**
     * @var $service AbstractService
     */
    protected $service;

    /**
     * @var $repository AbstractRepository
     */
    protected $repository;

    /**
     * @var $entityManager EntityManager
     */
    protected $entityManager;

    /**
     * @var array
     */
    protected $args = [
        'icon' => 'fa fa-warning',
        'title' => 'OPPSS!',
        'msg' => 'Não conseguimos atender a sua solicitação!',
        'type' => 'error',
    ];
    /**
     * @var $message Messages
     */
    protected $message;
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var array
     */
    protected $user = ['first_name' => "Admin"];
    /**
     * @var $form AbstractForm
     */
    protected $form;
    /**
     * @var $serviceManager ServiceManager
     */
    protected $serviceManager;
    /**
     * @var $template
     */
    protected $template;
    /**
     * @var $filter AbstractFilter
     */
    protected $filter;
    /**
     * @var $imageManager
     */
    protected $imageManager;

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     */
    abstract public function __construct(ContainerInterface $container);

    public function onDispatch(MvcEvent $e)
    {
        $this->serviceManager = $this->container->get(ServiceManager::class);
        $this->user = $this->identity();
        return parent::onDispatch($e); // TODO: Change the autogenerated stub
    }


    public function indexAction()
    {

        if (!$this->identity()):

            return $this->auth();
        endif;
        return new ViewModel([
            'route' => $this->route,
            'controller' => $this->controller
        ]);
    }

    public function listarAction()
    {
        if (!$this->identity()):
            return $this->auth();
        endif;
        //I don't know if it necesary to validate that request is POST
        $queryBuilder = $this->repository->createQueryBuilder("p");
        $this->table->setSource($queryBuilder)
            ->setRoute($this->getRoute($this->route))
            ->setController($this->controller)
            ->setParamAdapter($this->getRequest()->getPost());
        $view = $this->table->render();
        //$view = $this->table->render('custom',sprintf('admin/cidade/%s/listar', LAYOUT));
        //$view = $this->table->render('dataTableAjaxInit');
        //$view = $this->table->render('dataTableJson');
        //$view = $this->table->render('newDataTableJson');
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;

    }


    public function createAction()
    {
        if (!$this->identity()):
            return $this->auth();
        endif;
        $id = $this->params()->fromRoute("id", 0);
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if ($id) {
            $data = $this->repository->find($id);
            if (!$data) {
                return $this->redirect()->toRoute(sprintf("%s/default", $this->getRoute($this->route)),
                    [
                        'controller' => $this->controller,
                        'action' => "create"
                    ]);
            }
            $this->form->setData($this->extracted($data->toArray()));
        } else {
            $this->form->get('save_copy')->setAttribute('disabled', true);
        }
        $view = new ViewModel($this->args);
        $view->setVariable('id', $id);
        $view->setVariable('form', $this->form);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }

    public function saveAction()
    {
        if (!$this->identity()):
            return $this->restrict();
        endif;
        if (is_string($this->service)):
            $this->getService();
        endif;
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if (is_string($this->filter)):
            $this->getFilter();
        endif;
        if ($this->params()->fromPost()) {
            if (!$this->data):
                $this->data = array_merge_recursive(
                    $this->params()->fromPost(),
                    $this->params()->fromFiles()
                );
            endif;
            $this->form->setData($this->data)->setInputFilter($this->filter->getInputFilter());
            if ($this->form->isValid()):
                $this->args = array_merge($this->args, $this->service->save($this->data));
                if ($this->args['result']):
                    $this->addMessage($this->args['msg'], $this->args['type']);
                    if ($this->params()->fromPost('submit')):
                        $data = $this->extracted($this->args['entity']->toArray());
                    elseif ($this->params()->fromPost('save_copy')):
                        $data = $this->copy($this->args['entity']->toArray(), 'copy');
                        $data['id'] = "";
                        $this->args = array_merge($this->args, $this->service->save($data));
                        $this->addRedirect([sprintf("%s/default", $this->getRoute($this->route)), [
                            'controller' => $this->controller,
                            'action' => 'create',
                            'id' => $this->args['entity']->getId()
                        ]])->addTime(1000);
                    elseif ($this->params()->fromPost('save_close')):
                        $data = $this->extracted($this->args['entity']->toArray());
                        $this->addRedirect([sprintf("%s/default", $this->getRoute($this->route)), [
                            'controller' => $this->controller,
                            'action' => 'index',
                        ]])->addTime(1000);
                    endif;
                    $this->form->setData($data);

                else:

                    $this->addMessage($this->args['msg'], $this->args['type']);
                endif;
            else:
                $Msgs = $this->form->getMessages();
                if ($Msgs):
                    $ArayMsg = [];
                    foreach ($Msgs as $msg) {
                        $ArayMsg[] = array_pop($msg);
                    }
                    $this->args['msg'] = implode(PHP_EOL, $ArayMsg);
                    //d($this->args['msg']);
                endif;
                $this->addMessage($this->args['msg'], 'info');
            endif;
        }
        $view = new ViewModel($this->args);
        $view->setVariable('form', $this->form);
        $view->setTerminal(true);
        $view->setTemplate($this->template);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }

    public function deleteAction()
    {
        if (!$this->identity()):
            return $this->restrict();
        endif;
        if (!$this->params()->fromPost()):
            return new JsonModel($this->args);
        endif;
        if (!$this->params()->fromRoute('id')):
            return new JsonModel($this->args);
        endif;
        $Data = $this->params()->fromPost('id');
        if (!is_array($Data)):
            $Data = [$Data];
        endif;
        if (is_string($this->service)):
            $this->getService();
        endif;
        foreach ($Data as $datum):
            $this->args = array_merge($this->args, $this->service->remove(["id" => $datum]));
        endforeach;
        return new JsonModel($this->args);
    }

    public function stateAction()
    {
        if (!$this->identity()):
            return $this->restrict();
        endif;
        if (!$this->params()->fromPost()):
            return new JsonModel($this->args);
        endif;
        if (!$this->params()->fromRoute('id')):
            return new JsonModel($this->args);
        endif;
        $Data = $this->params()->fromPost('id');
        if (!is_array($Data)):
            $Data = [$Data];
        endif;
        if (is_string($this->service)):
            $this->getService();
        endif;
        foreach ($Data as $datum):
            if ($this->service->state($datum, $this->params()->fromRoute('id'))) {
                $this->args['msg'] = "Registro(s) Atualizado Com Sucesso!";
                $this->args['type'] = "success";
            }
        endforeach;
        return new JsonModel($this->args);
    }

    public function uploadAction()
    {
        if ($this->params()->fromPost()):
            if (!$this->identity()):
                return $this->restrict();
            endif;
        else:
            if (!$this->identity()):
                return $this->auth();
            endif;
        endif;

        if (is_string($this->service)):
            $this->getService();
        endif;
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if (is_string($this->filter)):
            $this->getFilter();
        endif;
        $view = new ViewModel([
            'route' => $this->getRoute($this->route),
            'controller' => $this->controller,
        ]);
        $view->setTemplate("admin/upload/create");
        $view->setVariable('assets', $this->params()->fromQuery('assets'));
        $view->setVariable('parent', $this->params()->fromQuery('parent'));
        $Result = $this->UploadPlugin()
            ->setService($this->service)
            ->setForm($this->form)
            ->setImagesUpload($this->container->get(ImagesUpload::class))
            ->setFilter($this->filter)
            ->setRepository($this->repository)
            ->setQuery($this->params()->fromQuery())
            ->setData($this->params()->fromPost())
            ->setFile($this->params()->fromFiles())
            ->upload($this->getRequest()->getServer('DOCUMENT_ROOT'));
        $view->setTerminal(true);
        if ($this->params()->fromPost()):
            return new JsonModel($Result);
        endif;
        $view->setVariable('form', $this->UploadPlugin()->getForm());
        return $view;
    }

    public function uploadmceAction()
    {
        if (!$this->identity()):
            return $this->restrict();
        endif;
        $this->user = $this->identity();
        $Result = $this->UploadPlugin()
            ->setImagesUpload($this->container->get(ImagesUpload::class))
            ->setFile($this->params()->fromFiles())
            ->uploadmce($this->controller,
                $this->params()->fromRoute("id", 0),
                $this->getRequest()->getServer('DOCUMENT_ROOT'));
        return new JsonModel($Result);
    }

    /**
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function fileAction()
    {
        return $this->ImagePlugin()->get($this);
    }

    protected function extracted($data, $suffix = "copy")
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \Datetime):
                $data[$key] = $value->format("Y/m/d");
            else:
                if ($value instanceof AbstractEntity) {
                    $methodName = 'get' . ucfirst($key);
                    if (method_exists($value, $methodName)) {
                        $value = $value->getId();
                    }
                }
                if (strstr($value, $suffix, true)) {
                    $data[$key] = strstr($value, $suffix, true);
                } else {
                    $data[$key] = $value;
                }

            endif;
        }
        return $data;
    }

    protected function copy($data, $suffix = "")
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \Datetime):
                $data[$key] = $value->format("Y/m/d");
            else:
                if (is_integer($value) || is_double($value) || $key == "status" || $key == "empresa"):
                    $data[$key] = $value;
                else:
                    $data[$key] = sprintf("%s%s", $value, $suffix);
                endif;
            endif;
        }
        return $data;
    }

    /**
     * @param string $table
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setTable($table)
    {
        $this->table = $this->serviceManager->get($table);
        return $this;
    }


    /**
     * @param mixed $container
     * @return AbstractController
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param string $controller
     * @return AbstractController
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return AbstractController
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param mixed $entity
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        if (!$this->repository) {
            $this->getRepository();
        }
        return $this;
    }

    /**
     * @return EntityManager
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getEm(): EntityManager
    {
        if (is_null($this->entityManager)):
            $this->setEntityManager();
        endif;
        return $this->entityManager;
    }


    /**
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setEntityManager()
    {
        $this->entityManager = $this->container->get("Doctrine\ORM\EntityManager");
        return $this;
    }

    /**
     * @param string $route
     * @return AbstractController
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getService()
    {
        if (!$this->container->has($this->service)):
            $this->setServiceManager($this->service, $this->factoryService);
            $this->service = $this->serviceManager->get($this->service);
        endif;
        return $this->service;
    }

    /**
     * @return AbstractFilter
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getFilter(): AbstractFilter
    {
        if (!$this->container->has($this->filter)):
            $this->setServiceManager($this->filter, $this->factoryFilter);
            $this->filter = $this->serviceManager->get($this->filter);
        endif;
        return $this->filter;
    }


    /**
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRepository()
    {
        $this->repository = $this->getEm()->getRepository($this->entity);
        return $this;
    }

    /**
     * @param $text
     * @param string $type
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addMessage($text, $type = "error")
    {
        if (!$this->serviceManager->has(Messages::class)) {
            $this->setServiceManager(Messages::class, InvokableFactory::class);
        }
        $this->message = $this->serviceManager->get(Messages::class);
        $this->message->addMessage($text, $type);
        return $this;
    }

    /**
     * @param $text
     * @param int $hops
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addRedirect($text, $hops = 1)
    {
        if (!$this->serviceManager->has(Messages::class)) {
            $this->setServiceManager(Messages::class, InvokableFactory::class);
        }
        $this->message = $this->serviceManager->get(Messages::class);
        $this->message->addRedirect($text, $hops);
        return $this;
    }

    /**
     * @param $time
     * @param int $hops
     * @return $this
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addTime($time, $hops = 1)
    {
        if (!$this->serviceManager->has(Messages::class)) {
            $this->setServiceManager(Messages::class, InvokableFactory::class);
        }
        $this->message = $this->serviceManager->get(Messages::class);
        $this->message->addTime($time, $hops);
        return $this;
    }


    /**
     * @param $config
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRoute($config)
    {
        if (isset($this->container->get("config")[$config])):
            return $this->container->get("config")[$config];
        endif;
        return $config;
    }

    /**
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getForm()
    {
        if (!$this->container->has($this->form)):
            $this->setServiceManager($this->form, $this->factoryForm);
        endif;
        $this->form = $this->serviceManager->get($this->form);
        return $this->form;
    }

    /**
     * @param $service
     * @param $factory
     * @param string $type
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setServiceManager($service, $factory, $type = "factories")
    {
        $this->serviceManager = $this->container->get(ServiceManager::class);
        $this->serviceManager->setFactory($service, $factory);
        return $this;
    }

    /**
     * @return \Zend\Http\Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function auth()
    {
       return $this->redirect()->toRoute($this->getRoute('adm-auth'));
    }

    /**
     * @return AbstractController|ViewModel
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function restrict()
    {

        $view = new ViewModel($this->args);
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        $view->setTemplate(sprintf("admin/admin/%s/restrict", LAYOUT));
        $this->layout("layout/auth");
        $this->addRedirect($this->getRoute('adm-auth'));
        return $view;

    }

    /**
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function quest()
    {
       return $this->redirect()->toRoute($this->getRoute('adm-admin'));
    }
}
