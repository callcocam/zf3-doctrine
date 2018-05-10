<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 22/03/2018
 * Time: 08:33
 */

namespace Admin\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Admin\Repository\MenuRepository")
 */
class MenuEntity extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\EmpresaEntity")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     */
    private $empresa = 1;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\GroupEntity")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;
     /**
     * @var ResourceEntity
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\ResourceEntity")
     * @ORM\JoinColumn(name="route", referencedColumnName="id")
     */
    private $route;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=50, nullable=false)
     */
    private $controller;
    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=false)
     */
    private $action;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\RoleEntity")
     * @ORM\JoinColumn(name="role", referencedColumnName="id")
     */
    private $role;
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=150, nullable=false)
     */
    private $alias;
    /**
     * @var string
     *
     * @ORM\Column(name="icone", type="string", length=50, nullable=false)
     */
    private $icone;
    /**
     * @var int|null
     *
     * @ORM\Column(name="ordem", type="integer", nullable=true)
     */
    private $ordem = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var \DateTime|null
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")

     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param EmpresaEntity $empresa
     * @return MenuEntity
     */
    public function setEmpresa( EmpresaEntity $empresa )
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int|null $parent
     * @return MenuEntity
     */
    public function setParent(  $parent )
    {
        $this->parent = $parent;
        return $this;
    }


    /**
     * @return ResourceEntity
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param ResourceEntity $route
     * @return MenuEntity
     */
    public function setRoute( $route )
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return MenuEntity
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return MenuEntity
     */
    public function setController( $controller )
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return MenuEntity
     */
    public function setAction( $action )
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int|null $role
     * @return MenuEntity
     */
    public function setRole( $role )
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return MenuEntity
     */
    public function setAlias( $alias )
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * @param string $icone
     * @return MenuEntity
     */
    public function setIcone( $icone )
    {
        $this->icone = $icone;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param int|null $ordem
     * @return MenuEntity
     */
    public function setOrdem( $ordem )
    {
        $this->ordem = $ordem;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MenuEntity
     */
    public function setDescription( $description )
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return MenuEntity
     */
    public function setStatus( $status )
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return MenuEntity
     */
    public function setCreatedAt( $createdAt )
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return MenuEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}