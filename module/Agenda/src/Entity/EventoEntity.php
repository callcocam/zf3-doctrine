<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Agenda\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;
    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\ClientEntity")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;
    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Agenda\Entity\CategorieEntity")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorieId;
    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start", type="datetime", nullable=true)
     */
    private $start;
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;
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
    public function setTitle( string $title )
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getClient(): ?int
    {
        return $this->client;
    }

    /**
     * @param int|null $client
     * @return EventoEntity
     */
    public function setClient( ?int $client )
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategorieId()
    {
        return $this->categorieId;
    }

    /**
     * @param int|null $categorieId
     * @return EventoEntity
     */
    public function setCategorieId( $categorieId )
    {
        $this->categorieId = $categorieId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param int|null $author
     * @return EventoEntity
     */
    public function setAuthor(  $author )
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime|null $start
     * @return EventoEntity
     */
    public function setStart( $start )
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime|null $end
     * @return EventoEntity
     */
    public function setEnd( $end )
    {
        $this->end = $end;
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
     * @return EventoEntity
     */
    public function setStatus( int $status )
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



}