<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace SIGAUpload\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="upload")
 * @ORM\Entity(repositoryClass="\SIGAUpload\Repository\UploadRepository")
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
     * @ORM\Column(name="tipo", type="string", length=10, nullable=false, options={"default"="upload"})
     */
    private $tipo;
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
     * @ORM\Column(name="cover_width", type="integer", nullable=true, options={"default"="500"})
     */
    private $coverWidth;
    /**
     * @var int
     *
     * @ORM\Column(name="cover_height", type="integer", nullable=true, options={"default"="500"})
     */
    private $coverHeight;
    /**
     * @var int
     *
     * @ORM\Column(name="cover_quality", type="integer", nullable=true, options={"default"="90"})
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
    public function setEmpresa( $empresa )
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     * @return UploadEntity
     */
    public function setParent( $parent )
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param string $assets
     * @return UploadEntity
     */
    public function setAssets( string $assets ): UploadEntity
    {
        $this->assets = $assets;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return UploadEntity
     */
    public function setTipo( string $tipo ): UploadEntity
    {
        $this->tipo = $tipo;
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
     * @return UploadEntity
     */
    public function setName( string $name ): UploadEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return UploadEntity
     */
    public function setPath( string $path ): UploadEntity
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     * @return UploadEntity
     */
    public function setCover( string $cover ): UploadEntity
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverWidth()
    {
        return $this->coverWidth;
    }

    /**
     * @param int $coverWidth
     * @return UploadEntity
     */
    public function setCoverWidth( $coverWidth ): UploadEntity
    {
        $this->coverWidth = $coverWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverHeight()
    {
        return $this->coverHeight;
    }

    /**
     * @param int $coverHeight
     * @return UploadEntity
     */
    public function setCoverHeight( $coverHeight ): UploadEntity
    {
        $this->coverHeight = $coverHeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoverQuality()
    {
        return $this->coverQuality;
    }

    /**
     * @param int $coverQuality
     * @return UploadEntity
     */
    public function setCoverQuality( $coverQuality ): UploadEntity
    {
        $this->coverQuality = $coverQuality;
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
     * @return UploadEntity
     */
    public function setDescription( string $description ): UploadEntity
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
    public function setStatus( int $status ): UploadEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime|null $created_at
     * @return UploadEntity
     */
    public function setCreatedAt( ?\DateTime $created_at )
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     * @return UploadEntity
     */
    public function setUpdatedAt( \DateTime $updated_at )
    {
        $this->updated_at = $updated_at;
        return $this;
    }


}