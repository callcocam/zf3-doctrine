<?php

namespace Core\Permissions;

use Zend\Permissions\Acl\Acl as ZendAcl,
    Zend\Permissions\Acl\Role\GenericRole as Role,
    Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * Acl
 */
class Acl extends ZendAcl
{

    private $Roles;
    private $Resources;
    private $Privileges;
    private $isAdmin = false;
    private $allRoles;
    private $container;


    /**
     * AclHelper constructor.
     * @param $container
     * @param $Roles
     * @param $Privileges
     */
    public function __construct($container, $Roles, $Privileges)
    {
        $this->container = $container;
        $this->setRoles($Roles);
        $this->setResources(array_merge($this->getConfigResources('factories'),
            $this->getConfigResources('invokables')));
        $this->setPrivileges($Privileges);

    }

    /**
     * @param $Resources
     * @return Acl
     */
    public function setResources($Resources)
    {
       $this->Resources = $Resources;
        if ($this->Resources):
            foreach ($this->Resources as $key => $resource) {
                if (!$this->hasResource($key)) {
                    $this->addResource(new Resource($key));
                }
            }
        endif;
        return $this;
    }

    /**
     * @param $Roles
     * @return Acl
     */
    public function setRoles($Roles)
    {
        $sql = $Roles->createQueryBuilder('R');
        $sql->where($sql->expr()->eq('R.status', 1))->orderBy('R.id', 'DESC');
        $this->Roles = $sql->getQuery()->getResult();
        if ($this->Roles):
            foreach ($this->Roles as $role) {
                //Verifica a role ja foi add
                if (!$this->hasRole((string)$role->getId())) {
                    //Inicia os parents da role ex:1 e parent da 2 a 2 da 3 etc
                    //a 1 herda da 2,3,4 e 5
                    $parentNames = array();
                    if (!is_null($role->getParent()) && (int)$role->getParent()) {
                        $parentNames = (string)$role->getParent();
                    }
                    //Adiciana a role
                    $this->addRole(new Role((string)$role->getId()), $parentNames);
                }
                //Se a role for admin conceda totos os privileges
                if ($role->getIsAdmin()) {
                    $this->isAdmin = $role->getId();
                }
                $this->allRoles[] = $role->getId();
            }
        endif;
        return $this;
    }

    /**
     * @param mixed $Privileges
     * @return Acl
     */
    public function setPrivileges($Privileges)
    {
        $sql = $Privileges->createQueryBuilder('R');
        $sql->where($sql->expr()->eq('R.status', 1));
        $this->Privileges = $sql->getQuery()->getResult();
        if ($this->Privileges):
            foreach ($this->Privileges as $privilege) {
                $allprivileges = array_merge(explode(",", $privilege->getAction()), explode(",", $privilege->getParent()));
                $this->allow($privilege->getRole(), $privilege->getController(), $allprivileges);
            }
        endif;
        $this->allow($this->allRoles, ['Admin\Controller\Admin', 'Auth\Controller\Auth'], null);
        if ($this->isAdmin):
            $this->allow($this->isAdmin, null, null);
        endif;
        return $this;
    }
    protected function getConfigResources($string)
    {
        if(!isset($this->container->get('Config')['controllers'][$string])):
            return [];
        endif;
        return $this->container->get('Config')['controllers'][$string];

    }

}
