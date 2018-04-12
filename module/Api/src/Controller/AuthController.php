<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/04/2018
 * Time: 16:16
 */

namespace Api\Controller;


use Auth\Adapter\Authentication;
use Interop\Container\ContainerInterface;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\View\Model\JsonModel;

class AuthController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {

        $this->filter = 'Api\Filter\LoginFilter';
        $this->service = 'Auth\Service\AuthService';
        $this->route = "api-auth";
        $this->controller = "auth";
        $this->container = $container;
    }

    public function getList()
    {
        $config = $this->getEvent()->getParam('config', false);
        $this->httpStatusCode = 404;
        $this->apiResponse = [$config['ApiRequest']['responseFormat']['errorKey'] => "Welcome to the Zend Framework Album API example"];
        return $this->createResponse();
    }

    public function get($id)
    {
        $config = $this->getEvent()->getParam('config', false);
        $this->httpStatusCode = 404;
        $this->apiResponse = [$config['ApiRequest']['responseFormat']['errorKey'] => "Welcome to the Zend Framework Album API example"];
        return $this->createResponse();
    }


    /**
     * @param $data
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function create($data) {
        if(!$data):
            $this->httpStatusCode = 401;
            return $this->createResponse();
        endif;

        if (is_string($this->service)):
            $this->getService();
        endif;
        $this->getFilter();
        /**
         * Pega o inputFilter Validate
         */
        $validate = $this->filter->getInputFilter();

        // generate token if valid user
        $validate->setData($data);
        if($validate->isValid()):
            /**
             * @var $auth Authentication
             */
            $auth = $this->serviceManager->get(Authentication::class);
            $password = $this->service->encryptPassword($data['email'],$data['password']);

            $Result = $auth->login($data['email'],$password);

            if($Result->isValid()):
                $this->apiResponse['user'] = [
                    'id'=>$this->identity()->getId(),
                    'firstName'=>$this->identity()->getFirstName(),
                    'lastName'=>$this->identity()->getLastName(),
                    'empresa'=>$this->identity()->getEmpresa()->getId(),
                    'email'=>$this->identity()->getEmail(),
                    'cover'=>$this->identity()->getCover(),
                    'access'=>$this->identity()->getAccess()->getId(),
                ];
                $this->apiResponse['token'] = $this->generateJwtToken($data);
                // Set the HTTP status code. By default, it is set to 200
                $this->httpStatusCode = 200;
            else:
                // Set the HTTP status code. By default, it is set to 200
                $this->httpStatusCode = 401;
                $this->apiResponse['defaultErrorText'] = $auth->getResult();

            endif;


        else:
            // Set the HTTP status code. By default, it is set to 200
            $this->httpStatusCode = 401;
            $this->getMessages($validate->getMessages());
        endif;
        return $this->createResponse();
    }

}