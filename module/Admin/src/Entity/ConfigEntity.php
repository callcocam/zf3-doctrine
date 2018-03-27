<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="config", uniqueConstraints={@ORM\UniqueConstraint(name="config_id", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\ConfigRepository")
 * @ORM\Entity
 */
class ConfigEntity extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(name="conf_name", type="string", length=150, nullable=true, options={"default"="Claudio Campos"})
     */
    private $confName;
    /**
     * @var string
     *
     * @ORM\Column(name="conf_value", type="string", length=150, nullable=true, options={"default"="contato@sigasmart.com.br"})
     */
    private $confValue;
    /**
     * @var string
     *
     * @ORM\Column(name="conf_type", type="string", length=150, nullable=true, options={"default"="contato@sigasmart.com.br"})
     */
    private $confType;

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
     * @return string
     */
    public function getConfName()
    {
        return $this->confName;
    }

    /**
     * @param string $confName
     * @return ConfigEntity
     */
    public function setConfName( $confName)
    {
        $this->confName = $confName;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfValue()
    {
        return $this->confValue;
    }

    /**
     * @param string $confValue
     * @return ConfigEntity
     */
    public function setConfValue( $confValue)
    {
        $this->confValue = $confValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfType()
    {
        return $this->confType;
    }

    /**
     * @param string $confType
     * @return ConfigEntity
     */
    public function setConfType( $confType)
    {
        $this->confType = $confType;
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
     * @return ConfigEntity
     */
    public function setStatus( $status)
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
     * @return ConfigEntity
     */
    public function setCreatedAt($createdAt)
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
     * @return ConfigEntity
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}