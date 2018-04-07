<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="categorie_product")
 * @ORM\Entity(repositoryClass="\ControlDeEstoque\Repository\CategoriaRepository")
 * @ORM\Entity
 */
class CategoriaEntity extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';
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
     * @param EmpresaEntity|null $empresa
     * @return CategoriaEntity
     */
    public function setEmpresa(  $empresa )
    {
        $this->empresa = $empresa;
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
     * @return CategoriaEntity
     */
    public function setName( $name )
    {
        $this->name = $name;
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
     * @return CategoriaEntity
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
     * @return CategoriaEntity
     */
    public function setPreview( $preview )
    {
        $this->preview = $preview;
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
     * @return CategoriaEntity
     */
    public function setCover( $cover )
    {
        $this->cover = $cover;
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
     * @return CategoriaEntity
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
     * @return CategoriaEntity
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
     * @return CategoriaEntity
     */
    public function setUpdatedAt(  $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }



}