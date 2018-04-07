<?php

namespace Admin\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Core\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Privilege
 *
 * @ORM\Table(name="privilege")
 * @ORM\Entity(repositoryClass="\Admin\Repository\PrivilegeRepository")
 * @ORM\Entity
 */
class PrivilegeEntity extends AbstractEntity
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\EmpresaEntity")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=50, nullable=false, options={"default"="admin"})
     */
    private $controller = 'admin';

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent", type="string", length=255, nullable=true)
     */
    private $parent;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    private $role;

    /**
     * @var int
     *
     * @ORM\Column(name="resource", type="integer", nullable=false)
     */
    private $resource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set empresa.
     *
     * @param int $empresa
     *
     * @return PrivilegeEntity
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa.
     *
     * @return int
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return PrivilegeEntity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set controller.
     *
     * @param string $controller
     *
     * @return PrivilegeEntity
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set action.
     *
     * @param string $action
     *
     * @return PrivilegeEntity
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set parent.
     *
     * @param string|null $parent
     *
     * @return PrivilegeEntity
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set role.
     *
     * @param int $role
     *
     * @return PrivilegeEntity
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set resource.
     *
     * @param int $resource
     *
     * @return PrivilegeEntity
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource.
     *
     * @return int
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return PrivilegeEntity
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return PrivilegeEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return PrivilegeEntity
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return PrivilegeEntity
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
