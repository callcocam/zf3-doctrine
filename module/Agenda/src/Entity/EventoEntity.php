<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Agenda\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="\Agenda\Repository\EventoRepository")
 * @ORM\Entity
 */
class EventoEntity extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="class_name", type="string", length=50, nullable=false, options={"default"="bg-success"})
     */
    private $class_name;

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
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

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
     * @param int|null $empresa
     * @return EventoEntity
     */
    public function setEmpresa(  $empresa )
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return EventoEntity
     */
    public function setTitle(  $title )
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->class_name;
    }

    /**
     * @param string $class_name
     * @return EventoEntity
     */
    public function setClassName( string $class_name ): EventoEntity
    {
        $this->class_name = $class_name;
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
     * @return EventoEntity
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
     * @return EventoEntity
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
     * @return EventoEntity
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
     * @return EventoEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    //Depois use generate get and set



}