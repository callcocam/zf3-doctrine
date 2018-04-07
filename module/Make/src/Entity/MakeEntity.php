<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 01:14
 */

namespace Make\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Admin\Entity\EmpresaEntity;
use Core\Entity\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Make
 *
 * @ORM\Table(name="make", uniqueConstraints={@ORM\UniqueConstraint(name="make_controller", columns={"controller"})})
 * @ORM\Entity(repositoryClass="\Make\Repository\MakeRepository")
 * @ORM\Entity
 */
class MakeEntity extends AbstractEntity
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
     * @var EmpresaEntity
     *
     * @ORM\ManyToOne(targetEntity="\Admin\Entity\EmpresaEntity")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     */
    private $empresa = 1;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=10, nullable=false, options={"default"="menu"})
     */
    private $menu;
    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=50, nullable=false)
     */
    private $route;
    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=50, nullable=false)
     */
    private $controller;
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=false)
     */
    private $alias;

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
    private $created_at;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")

     */
    private $updated_at;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return EmpresaEntity
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param $empresa
     * @return MakeEntity
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return MakeEntity
     */
    public function setName(string $name): MakeEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getMenu(): string
    {
        return $this->menu;
    }

    /**
     * @param string $menu
     * @return MakeEntity
     */
    public function setMenu( string $menu ): MakeEntity
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return MakeEntity
     */
    public function setRoute(string $route): MakeEntity
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return MakeEntity
     */
    public function setController(string $controller): MakeEntity
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return MakeEntity
     */
    public function setAlias(string $alias): MakeEntity
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MakeEntity
     */
    public function setDescription(string $description): MakeEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return MakeEntity
     */
    public function setStatus(int $status): MakeEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return MakeEntity
     */
    public function setCreatedAt(?\DateTime $createdAt): MakeEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return MakeEntity
     */
    public function setUpdatedAt(\DateTime $updatedAt): MakeEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}