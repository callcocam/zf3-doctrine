<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace ControleEstoque\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="\ControleEstoque\Repository\ProductRepository")
 * @ORM\Entity
 */
class ProductEntity extends AbstractEntity
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
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;
    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="integer", nullable=true)
     */
    private $parent;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code = '';
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
     * @var float
     *
     * @ORM\Column(name="costs", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $costs = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="marge", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $marge = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="width", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $width = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $height = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $weight = '0.00';
    /**
     * @var float
     *
     * @ORM\Column(name="greeting", type="float", precision=9, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $greeting = '0.00';
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param int|null $author
     * @return ProductEntity
     */
    public function setAuthor( $author )
    {
        $this->author = $author;
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
     * @return ProductEntity
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
     * @return ProductEntity
     */
    public function setParent( $parent )
    {
        $this->parent = $parent;
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
     * @return ProductEntity
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ProductEntity
     */
    public function setCode( $code )
    {
        $this->code = $code;
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
     * @return ProductEntity
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
     * @return ProductEntity
     */
    public function setCover( string $cover )
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return float
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param float $costs
     * @return ProductEntity
     */
    public function setCosts( $costs )
    {
        $this->costs = $costs;
        return $this;
    }

    /**
     * @return float
     */
    public function getMarge()
    {
        return $this->marge;
    }

    /**
     * @param float $marge
     * @return ProductEntity
     */
    public function setMarge( $marge )
    {
        $this->marge = $marge;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductEntity
     */
    public function setPrice( $price )
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return ProductEntity
     */
    public function setWidth( $width )
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     * @return ProductEntity
     */
    public function setHeight( $height )
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return ProductEntity
     */
    public function setWeight( $weight )
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return float
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    /**
     * @param float $greeting
     * @return ProductEntity
     */
    public function setGreeting( $greeting )
    {
        $this->greeting = $greeting;
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
     * @return ProductEntity
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
     * @return ProductEntity
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
     * @return ProductEntity
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
     * @return ProductEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}