<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

class MenuForm extends AbstractForm
{

    public function __construct( $name = null, array $options = [] )
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut", [
            'controller' => "menu",
            'action' => 'create'
        ]);

        $this->util = new Utils();
        ################# name #################
        $this->addText('name', 'Nome\Descrição');
        ################# icone #################
        $this->addText('icone', 'Icone');
        ################# role #################
        $this->setRotulo("role", "Nivel De Acesso");
        $this->addObjectSelect('role', 'Admin\Entity\RoleEntity', 'name');
        ################# controller #################
        $this->addText('controller', 'Controller');
        ################# action #################
        $this->addText('action', 'Ação');
        ################# description #################
        $this->addTextArea('description', 'Dica de tela');
        $resources = array_merge($this->getResources('invokables'), $this->getResources('factories'));
        ################# alias #################
        $this->addSelect('alias', 'Nome real', $resources);
        ################# ordem #################
        $this->setRotulo("ordem", "Ordem");
        $this->addObjectSelect('ordem', 'Admin\Entity\MenuEntity', 'name');
        ################# route #################
        $this->setRotulo("route", "Rota");
        $this->addObjectSelect('route', 'Admin\Entity\ResourceEntity', 'name');
        ################# parent #################
        $this->setRotulo("parent", "Grupo de Menu");
        $this->addObjectSelect('parent', 'Admin\Entity\GroupEntity', 'name');

    }


}