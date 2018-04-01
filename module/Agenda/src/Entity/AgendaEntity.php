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
 * @ORM\Table(name="agenda")
 * @ORM\Entity(repositoryClass="\Agenda\Repository\AgendaRepository")
 * @ORM\Entity
 */
class AgendaEntity extends AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="Agenda\Entity\EventoEntity")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $eventId;

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
     * @param int $id
     * @return AgendaEntity
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
     * @return AgendaEntity
     */
    public function setEmpresa( $empresa )
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
     * @return AgendaEntity
     */
    public function setTitle( $title )
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int|null $client
     * @return AgendaEntity
     */
    public function setClient( $client )
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param int|null $eventId
     * @return AgendaEntity
     */
    public function setEventId(  $eventId )
    {
        $this->eventId = $eventId;
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
     * @return AgendaEntity
     */
    public function setAuthor( $author )
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
     * @return AgendaEntity
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
     * @return AgendaEntity
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
     * @return AgendaEntity
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
     * @return AgendaEntity
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
     * @return AgendaEntity
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
     * @return AgendaEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}