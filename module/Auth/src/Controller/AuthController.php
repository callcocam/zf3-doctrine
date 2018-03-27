<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Auth\Controller;


use Auth\Adapter\Authentication;
use Core\Controller\AbstractController;
use Core\Module;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractController
{

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->form = 'Auth\Form\LoginForm';
        $this->service = 'Auth\Service\AuthService';
        $this->filter = 'Auth\Filter\LoginFilter';
		$this->route = "adm-auth";
		$this->controller = "auth";
	}
	public function loginAction()
	{
        if ($this->identity()):
            return $this->quest();
        endif;
        $this->user = $this->identity();
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
        $this->service->createAdminUserIfNotExists();
        $this->data = $this->params()->fromPost();
        $view->setTemplate(sprintf("auth/%s/login", LAYOUT));
        if($this->data):
            $this->form->setData($this->data);
            $this->form->setInputFilter($this->filter->getInputFilter());
            if ($this->form->isValid()):
                $auth = $this->container->get(Authentication::class);
                $password = $this->service->encryptPassword($this->params()->fromPost('email'),$this->params()->fromPost('password'));
                $Result = $auth->login($this->params()->fromPost('email'),$password);
                $this->addMessage($auth->getResult(),$auth->getType());
                if($Result->isValid()):
                    $this->addRedirect($this->getRoute('adm-admin'));
                endif;
            endif;
            $view->setTerminal(true);
            $view->setTemplate(sprintf("auth/%s/login-form", LAYOUT));
        endif;
        $view->setVariable(  'form', $this->form);
		return $view;
	}


	public function registerAction(){
        if ($this->identity()):
            return $this->quest();
        endif;
		$view = new ViewModel([
			'route'=>$this->getRoute($this->route),
			'controller'=>$this->controller
		]);
		$view->setTemplate(sprintf("auth/%s/register", LAYOUT));
		return $view;
	}

	public function recuperasenhaAction(){
        if ($this->identity()):
            return $this->quest();
        endif;
		$view = new ViewModel();
		$view->setTemplate(sprintf("auth/%s/recuperar-senha", LAYOUT));
		return $view;
	}

	public function recuperasenhaformAction(){
        if ($this->identity()):
            return $this->quest();
        endif;
		$this->setData()
			->getModel()
			->getForm()
			->getTable();
		if($this->params()->fromPost()):
			$this->form->setInputFilter($this->model->getInputFilterRecuperarSenha());
				if ($this->form->isValid()):
					$data = $this->table->findOneBy(['email'=>$this->params()->fromPost('email')]);
					if($data):
						$newSenha = substr(base64_encode(md5(date("YmdHis"))),0,10);
						$this->model->offsetSet('password', md5($this->encryptPassword($this->params()->fromPost('email'),$newSenha)));
						$this->model->offsetSet('id', $data['id']);
						$this->args = array_merge($this->args, $this->table->save($this->model));
						$this->helper->addMessage("{$newSenha} {$this->args['msg']}",$this->args['type']);
						$data['password'] = $newSenha;
						$data['sis'] = Module::SIS;
						$data['url'] = $this->getRequest()->getServer('HTTP_ORIGIN');
						$mail = new Mail($this->container);
						$mail->setSubject("Solicitação de recuperação de senha no site: " .Module::SIS)
							->setTo($data['email'])
							->setData($data)
							->setViewTemplate('recuperar-senha')
							->send();
						else:
						$this->helper->addMessage("OPSS! E-Mail não encontrado!",LoginTable::ERROR);
					endif;
				else:
					d($this->form->getMessages());
					$this->helper->addMessage("OPSS! Formulario invalido!",LoginTable::ERROR);
				endif;
		endif;
		$view = new ViewModel([
			'route'=>$this->getRoute($this->route),
			'controller'=>$this->controller,
			'form'=>$this->form
		]);
		$view->setTerminal(true);
		$view->setTemplate(sprintf("auth/%s/recuperar-senha-form", LAYOUT));
		return $view;

	}
	public function sairAction(){
        $auth = $this->container->get(Authentication::class);
		$auth->clearIdentity();
        return $this->auth();
	}

}