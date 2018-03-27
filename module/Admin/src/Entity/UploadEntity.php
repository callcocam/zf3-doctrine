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
 * @ORM\Table(name="upload")
 * @ORM\Entity(repositoryClass="Admin\Repository\UploadRepository")
 * @ORM\Entity
 */
class UploadEntity extends AbstractEntity
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
     * @var int
     *
     * @ORM\Column(name="parent", type="integer", nullable=true)
     */
    private $parent;
    /**
     * @var string
     *
     * @ORM\Column(name="assets", type="string", length=20, nullable=true)
     */
    private $assets;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;
    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=false, options={"default"="/dist/uploads/images/no_image.jpg"})
     */
    private $cover = '/dist/uploads/images/no_image.jpg';
    /**
     * @var int
     *
     * @ORM\Column(name="cover_width", type="integer", nullable=true)
     */
    private $coverWidth;
    /**
     * @var int
     *
     * @ORM\Column(name="cover_height", type="integer", nullable=true)
     */
    private $coverHeight;
    /**
     * @var int
     *
     * @ORM\Column(name="cover_quality", type="integer", nullable=true)
     */
    private $coverQuality;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
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
    public function getId(): int
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
     * @return UploadEntity
     */
    public function setEmpresa( $empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     * @return UploadEntity
     */
    public function setParent(int $parent): UploadEntity
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssets(): string
    {
        return $this->assets;
    }

    /**
     * @param string $assets
     * @return UploadEntity
     */
    public function setAssets(string $assets): UploadEntity
    {
        $this->assets = $assets;
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
     * @return UploadEntity
     */
    public function setName(string $name): UploadEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return UploadEntity
     */
    public function setPath(string $path): UploadEntity
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     * @return UploadEntity
     */
    public function setCover(string $cover): UploadEntity
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverWidth(): int
    {
        return $this->coverWidth;
    }

    /**
     * @param int $coverWidth
     * @return UploadEntity
     */
    public function setCoverWidth(int $coverWidth): UploadEntity
    {
        $this->coverWidth = $coverWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverHeight(): int
    {
        return $this->coverHeight;
    }

    /**
     * @param int $coverHeight
     * @return UploadEntity
     */
    public function setCoverHeight(int $coverHeight): UploadEntity
    {
        $this->coverHeight = $coverHeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverQuality(): int
    {
        return $this->coverQuality;
    }

    /**
     * @param int $coverQuality
     * @return UploadEntity
     */
    public function setCoverQuality(int $coverQuality): UploadEntity
    {
        $this->coverQuality = $coverQuality;
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
     * @return UploadEntity
     */
    public function setDescription(string $description): UploadEntity
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
     * @return UploadEntity
     */
    public function setStatus(int $status): UploadEntity
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
     * @return UploadEntity
     */
    public function setCreatedAt(?\DateTime $createdAt): UploadEntity
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
     * @return UploadEntity
     */
    public function setUpdatedAt(\DateTime $updatedAt): UploadEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    //Depois use generate get and set



}