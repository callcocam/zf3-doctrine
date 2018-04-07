<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="\Blog\Repository\PostRepository")
 * @ORM\Entity
 */
class PostEntity extends AbstractEntity
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
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;
    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\CategorieBlogEntity")
     * @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     */
    private $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';
    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     */
    private $alias = '';
    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="string", length=255, nullable=false)
     */
    private $preview = '';
    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=false, options={"default"="/dist/uploads/images/no_image.jpg"})
     */
    private $cover = '/dist/uploads/images/no_image.jpg';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;
    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer", nullable=true, options={"default"="0"})
     */
    private $views;
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var \DateTime|null
     *
     * @Gedmo\Timestampable(on="update")
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
     * @return PostEntity
     */
    public function setEmpresa( $empresa )
    {
        $this->empresa = $empresa;
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
     * @return PostEntity
     */
    public function setAuthor( $author )
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param int|null $categorie
     * @return PostEntity
     */
    public function setCategorie( $categorie )
    {
        $this->categorie = $categorie;
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
     * @return PostEntity
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     * @return PostEntity
     */
    public function setVideo( $video )
    {
        $this->video = $video;
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
     * @return PostEntity
     */
    public function setAlias( $alias )
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     * @return PostEntity
     */
    public function setPreview( $preview )
    {
        $this->preview = $preview;
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
     * @return PostEntity
     */
    public function setCover( $cover )
    {
        $this->cover = $cover;
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
     * @return PostEntity
     */
    public function setDescription( $description )
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param int $views
     * @return PostEntity
     */
    public function setViews( $views )
    {
        $this->views = $views;
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
     * @return PostEntity
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
     * @return PostEntity
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
     * @return PostEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }



}