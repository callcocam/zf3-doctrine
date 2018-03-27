<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Controller;

use Admin\Auth\AuthManager;
use Admin\Auth\UserManager;
use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\Authentication\Result;
use Zend\Debug\Debug;
use Zend\Uri\Uri;
use Zend\View\Model\ViewModel;

class UserController extends AbstractController
{
     /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-admin";
        $this->controller = "user";
        $this->template = sprintf("admin/user/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\UserService';
        $this->form = 'Admin\Form\UserForm';
        $this->filter = 'Admin\Filter\UserFilter';
        $this->setServiceManager('Admin\Table\UserTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\UserEntity')->setTable('Admin\Table\UserTable');


    }

    public function profileAction(){
        if (!$this->identity()):
            return $this->auth();
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
            'route'=>$this->getRoute($this->route),
            'controller'=>$this->controller,
        ]);
        $this->data = $this->params()->fromPost();
        $view->setTemplate("admin/profile/profile");
        if($this->data):
            $this->form->setData($this->data);
            $this->form->setInputFilter($this->filter->getInputFilter());
            if ($this->form->isValid()):
                $this->args = array_merge($this->args, $this->service->save($this->data));
                if ($this->args['result']):
                    $this->form->setData($this->extracted($this->args['entity']->toArray()));
                    $this->addMessage($this->args['msg'], $this->args['type']);
                endif;
            endif;
            $view->setTerminal(true);
            $view->setTemplate(sprintf("admin/profile/%s/editar-form", LAYOUT));
            else:
                $this->form->setData($this->extracted($this->user->toArray()));
        endif;
        $view->setVariable(  'form', $this->form);
        return $view;
    }

}