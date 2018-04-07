<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Group
 *
 * @ORM\Table(name="menu_group")
 * @ORM\Entity(repositoryClass="\Admin\Repository\GroupRepository")
 * @ORM\Entity
 */
class GroupEntity extends AbstractEntity
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
    private $empresa;
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
     * @param int $id
     * @return GroupEntity
     */
    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param int|null $empresa
     * @return GroupEntity
     */
    public function setEmpresa(  $empresa )
    {
        $this->empresa = $empresa;
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
     * @return GroupEntity
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
     * @return GroupEntity
     */
    public function setName( string $name )
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
     * @return GroupEntity
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
     * @return GroupEntity
     */
    public function setAction(  $action )
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return GroupEntity
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
     * @return GroupEntity
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
     * @return GroupEntity
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
     * @return GroupEntity
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
     * @return GroupEntity
     */
    public function setDescription(  $description )
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
     * @return GroupEntity
     */
    public function setStatus(  $status )
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
     * @return GroupEntity
     */
    public function setCreatedAt(  $createdAt )
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
     * @return GroupEntity
     */
    public function setUpdatedAt( \DateTime $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }




}