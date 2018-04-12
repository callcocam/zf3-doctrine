<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 09/04/2018
 * Time: 07:33
 */

namespace Api\Controller;


use Interop\Container\ContainerInterface;

class UserController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "adm-admin";
        $this->controller = "user";
        $this->template = sprintf("admin/user/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\UserService';
        $this->form = 'Admin\Form\UserForm';
        $this->filter = 'Admin\Filter\UserFilter';
        $this->setServiceManager('Api\Table\UserTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\UserEntity')->setTable('Api\Table\UserTable');
    }
    public function get( $id )
    {
        if ($id) {
            $data = $this->repository->find($id);
            if ($data) {
                $this->apiResponse = $this->extracted($data->toArray());
            }
        }
        unset($this->apiResponse['password'],$this->apiResponse['pwd_reset_token'],$this->apiResponse['pwd_reset_token_creation_date'],$this->apiResponse['user_active']);
        return $this->createResponse();
    }
}