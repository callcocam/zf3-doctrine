<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 23:09
 */

namespace Api\Controller;


use Core\Entity\AbstractEntity;
use Core\Filter\AbstractFilter;
use Core\Table\AbstractTable;
use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Interop\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Parameters;
use Zend\View\Model\JsonModel;

abstract class ApiController extends AbstractRestfulController
{
    protected $container;

    protected $repository;

    protected $service;

    protected $filter;
    /**
     * @var $table AbstractTable
     */
    protected $table;

    protected $route = "admin";

    protected $controller = "admin";

    protected $action = "index";

    protected $factoryService = "Core\\Service\\Factory\\FactoryService";

    protected $factoryTable = "Core\\Table\\Factory\\FactoryTable";

    protected $factoryFilter = "Core\\Filter\\Factory\\FactoryFilter";

    protected $factoryForm = "Core\\Form\\Factory\\FactoryForm";
    /**
     * @var Integer $httpStatusCode Define Api Response code.
     */
    protected $httpStatusCode = 200;
    /**
     * @var array $apiResponse Define response for api
     */
    protected $apiResponse;

    /**
     *
     * @var type string
     */
    protected $token;

    /**
     *
     * @var type Object or Array
     */
    protected $tokenPayload;

    /**
     * @var Adapter $dbAdapter
     */
    protected $dbAdapter;

    /**
     * @var $serviceManager
     */
    protected $serviceManager;


    /**
     * @var array
     */
    protected $args = [
        'icon' => 'fa fa-warning',
        'title' => 'OPPSS!',
        'msg' => 'Não conseguimos atender a sua solicitação!',
        'type' => 'error',
    ];
    protected $limit = 100000;

    protected $order = ['id' => 'DESC'];
    /**
     * @var EntityManager
     */
    protected $entityManager;
    protected $form;

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     */
    abstract public function __construct( ContainerInterface $container );


    /**
     * @param $data
     * @return JsonModel
     */
    public function create( $data )
    {
        $this->apiResponse=[];
        if(!$data):
            $this->httpStatusCode = 401;
            return $this->createResponse();
        endif;
        $this->save($data);
        $this->apiResponse = array_merge($this->args,$this->apiResponse);
        return $this->createResponse();
    }

    /**
     * @param $id
     * @return JsonModel
     */
    public function delete( $id )
    {
        // Action used for DELETE requests
        return new JsonModel(['data' => 'album id 3 deleted']);
    }

    /**
     * @param $id
     * @return JsonModel
     */
    public function get( $id )
    {
        if ($id) {
            $data = $this->repository->find($id);
            if ($data) {
                $this->apiResponse = $this->extracted($data->toArray());
            }
        }
        return $this->createResponse();
    }

    public function getList()
    {
        $params = $this->setParameters($this->params()->fromQuery());
        //$view = $this->apiModel->render('custom',sprintf('admin/cidade/%s/listar', LAYOUT));
        //$view = $this->apiModel->render('dataTableAjaxInit');
        //$view = $this->apiModel->render('dataTableJson');
        //$view = $this->apiModel->render('newDataTableJson');
        // Action used for GET requests without resource Id
        //I don't know if it necesary to validate that request is POST
        $queryBuilder = $this->repository->createQueryBuilder("p");
        $this->table->setSource($queryBuilder)
            ->setRoute($this->route)
            ->setController($this->controller)
            ->setParamAdapter($params);
        $this->apiResponse = $this->table->render('dataTableJson');
        return $this->createResponse();
    }

    /**
     * @param $id
     * @param $data
     * @return JsonModel
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update( $id, $data )
    {
        $this->apiResponse=[];
        if(!$data):
            $this->httpStatusCode = 401;
            return $this->createResponse();
        endif;
        if (is_string($this->service)):
            $this->getService();
        endif;
        if (is_string($this->filter)):
            $this->getFilter();
        endif;
        $action = $this->params()->fromQuery("action");
        $data['id'] = $id;
        switch ($action):
            case "status":
                $this->state($id, $data);
                break;
            default:
            $this->save($data);
        endswitch;
        $this->apiResponse = array_merge($this->args,$this->apiResponse);
        return $this->createResponse();
    }

    protected function save($data){
        /**
         * Pega o inputFilter Validate
         */
        $validate = $this->filter->getInputFilter();
        if(is_array($data['status'])):
            $data['status'] = $data['status']['value'];
        endif;
        // generate token if valid user
        $validate->setData($data);
        if($validate->isValid()):
            //$this->args = array_merge($this->args,['msg'=>'Formulario Validado com success']);
            $this->args = array_merge($this->args,$this->service->save($data));
        else:
            $this->getMessages($validate->getMessages());
        endif;
    }
    protected function setParameters( $params )
    {
        return new Parameters($params);
    }

    protected function extracted( $data, $suffix = "copy" )
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \Datetime):
                $data[$key] = $value->format("d/m/Y H:i:s");
            else:
                if ($value instanceof AbstractEntity) {
                    //$methodName = 'get' . ucfirst($key);
                    $value = $value->getId();

//                    if (method_exists($value, $methodName)) {
//                        $value = $value->getId();
//                    }
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
    /**
     * @param $service
     * @param $factory
     * @param string $type
     * @return ApiController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setServiceManager( $service, $factory, $type = "factories" )
    {
        $this->serviceManager = $this->container->get(ServiceManager::class);
        $this->serviceManager->setFactory($service, $factory);
        return $this;
    }

    /**
     * @param mixed $entity
     * @return ApiController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setEntity( $entity )
    {
        $this->entity = $entity;
        if (!$this->repository) {
            $this->getRepository();
        }
        return $this;
    }

    /**
     * @return ApiController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRepository()
    {
        $this->repository = $this->getEm()->getRepository($this->entity);
        return $this;
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
        endif;
        $this->filter = $this->serviceManager->get($this->filter);
        return $this->filter;
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
     * @return AbstractController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getService()
    {
        if (!$this->container->has($this->service)):
            $this->setServiceManager($this->service, $this->factoryService);
        endif;
        $this->service = $this->serviceManager->get($this->service);
        return $this->service;
    }

    /**
     * @return EntityManager
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getEm(): EntityManager
    {
        if (is_null($this->entityManager)):
            $this->entityManager = $this->container->get("Doctrine\ORM\EntityManager");
        endif;
        return $this->entityManager;
    }

    /**
     * @param string $table
     * @return ApiController
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setTable( $table )
    {
        $this->table = $this->serviceManager->get($table);
        return $this;
    }

    /**
     * set Event Manager to check Authorization
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function setEventManager( EventManagerInterface $events )
    {
        parent::setEventManager($events);
        //$events->attach('dispatch', [$this, 'setContainer'], 10);
        $events->attach('dispatch', [$this, 'checkAuthorization'], 11);
    }

    /**
     * This Function call from eventmanager to check authntication and token validation
     * @param type $event
     *
     */
    public function checkAuthorization( $event )
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $isAuthorizationRequired = $event->getRouteMatch()->getParam('isAuthorizationRequired');
        $config = $event->getApplication()->getServiceManager()->get('Config');
        $event->setParam('config', $config);
        if (isset($config['ApiRequest'])) {
            $responseStatusKey = $config['ApiRequest']['responseFormat']['statusKey'];
            if (!$isAuthorizationRequired) {
                return;
            }
            $jwtToken = $this->findJwtToken($request);

            if ($jwtToken) {
                $this->token = $jwtToken;
                $this->decodeJwtToken();
                if (is_object($this->tokenPayload)) {
                    return;
                }
                $response->setStatusCode(400);
                $jsonModelArr = [$responseStatusKey => $config['ApiRequest']['responseFormat']['statusNokText'], $config['ApiRequest']['responseFormat']['resultKey'] => [$config['ApiRequest']['responseFormat']['errorKey'] => $this->tokenPayload]];
            } else {
                $response->setStatusCode(401);
                $jsonModelArr = [
                    $responseStatusKey => $config['ApiRequest']['responseFormat']['statusNokText'],
                    $config['ApiRequest']['responseFormat']['resultKey'] => [
                        $config['ApiRequest']['responseFormat']['errorKey'] => $config['ApiRequest']['responseFormat']['authenticationRequireText']],
                ];
            }
        } else {
            $response->setStatusCode(400);
            $jsonModelArr = ['status' => 'NOK', 'result' => ['error' => 'Require copy this file vender\multidots\zf3-rest-api\config\restapi.global.php and paste to root config\autoload\restapi.global.php']];
        }

        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $view = new JsonModel($jsonModelArr);
        $response->setContent($view->serialize());
        return $response;
    }

    /**
     * Create Response for api Assign require data for response and check is valid response or give error
     * @return \Zend\View\Model\JsonModel
     *
     */
    public function createResponse()
    {
        $config = $this->getEvent()->getParam('config', false);
        $event = $this->getEvent();
        $response = $event->getResponse();

        if (is_array($this->apiResponse)) {
            $response->setStatusCode($this->httpStatusCode);
        } else {
            $this->httpStatusCode = 500;
            $response->setStatusCode($this->httpStatusCode);
            $errorKey = $config['ApiRequest']['responseFormat']['errorKey'];
            $defaultErrorText = $config['ApiRequest']['responseFormat']['defaultErrorText'];
            $this->apiResponse[$errorKey] = $defaultErrorText;
        }
        $statusKey = $config['ApiRequest']['responseFormat']['statusKey'];
        if ($this->httpStatusCode == 200) {
            $sendResponse[$statusKey] = $config['ApiRequest']['responseFormat']['statusOkText'];
        } else {
            $sendResponse[$statusKey] = $config['ApiRequest']['responseFormat']['statusNokText'];
        }
        if (isset($this->apiResponse['link'])) {
            $sendResponse['link'] = sprintf("%s%s", getenv('BASE'), $this->apiResponse['link']);
        }
        $sendResponse = $this->apiResponse;
        return new JsonModel($sendResponse);
    }

    /**
     * Check Request object have Authorization token or not
     * @param type $request
     * @return type String
     */
    public function findJwtToken( $request )
    {
        $jwtToken = $request->getHeaders("Authorization") ? $request->getHeaders("Authorization")->getFieldValue() : '';
        if ($jwtToken) {
            $jwtToken = trim(trim($jwtToken, "Bearer"), " ");
            return $jwtToken;
        }
        if ($request->isGet()) {
            $jwtToken = $request->getQuery('token');
        }
        if ($request->isPost()) {
            $jwtToken = $request->getPost('token');
        }
        return $jwtToken;
    }


    /**
     * contain encoded token for user.
     */
    protected function decodeJwtToken()
    {
        if (!$this->token) {
            $this->tokenPayload = false;
        }
        $config = $this->getEvent()->getParam('config', false);
        $cypherKey = $config['ApiRequest']['jwtAuth']['cypherKey'];
        $tokenAlgorithm = $config['ApiRequest']['jwtAuth']['tokenAlgorithm'];
        try {
            $decodeToken = JWT::decode($this->token, $cypherKey, [$tokenAlgorithm]);
            $this->tokenPayload = $decodeToken;
        } catch (\Exception $e) {
            $this->tokenPayload = $e->getMessage();
        }
    }

    /**
     * contain user information for createing JWT Token
     */
    protected function generateJwtToken( $payload )
    {
        if (!is_array($payload) && !is_object($payload)) {
            $this->token = false;
            return false;
        }
        $this->tokenPayload = $payload;
        $config = $this->getEvent()->getParam('config', false);
        $cypherKey = $config['ApiRequest']['jwtAuth']['cypherKey'];
        $tokenAlgorithm = $config['ApiRequest']['jwtAuth']['tokenAlgorithm'];
        $this->token = JWT::encode($this->tokenPayload, $cypherKey, $tokenAlgorithm);
        return $this->token;
    }
//
//    /**
//     * @param EventManagerInterface $event
//     */
//    public function setContainer($event){
//        $this->serviceManager = $event->getApplication()->getServiceManager();
//    }

    public function getMessages( $Messages )
    {
        if ($Messages):
            $ArayMsg = [];
            foreach ($Messages as $key => $msg) {
                $ArayMsg[$key] = array_pop($msg);
            }
            $this->apiResponse['zf_validate'] = $ArayMsg;
        endif;
    }
}