<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Core\Entity\AbstractEntity;

/**
 * Make
 *
 * @ORM\Table(name="visit", uniqueConstraints={@ORM\UniqueConstraint(name="visit_id", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\VisitRepository")
 */
class VisitEntity extends AbstractEntity
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
     * @ORM\Column(name="page", type="string", length=150, nullable=true)
     */
    private $page;
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=50, nullable=true, options={"default"="127.0.0.1"})
     */
    private $ip;
    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=150, nullable=true)
     */
    private $platform;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=150, nullable=true)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=150, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;
    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=50, nullable=true)
     */
    private $lat;
    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="string", length=50, nullable=true)
     */
    private $lon;
    /**
     * @var int
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;
    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer", nullable=true)
     */
    private $month;
    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;
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
     * @return VisitEntity
     */
    public function setEmpresa( $empresa): VisitEntity
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @param string $page
     * @return VisitEntity
     */
    public function setPage($page): VisitEntity
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return VisitEntity
     */
    public function setIp($ip): VisitEntity
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @return VisitEntity
     */
    public function setPlatform( $platform): VisitEntity
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return VisitEntity
     */
    public function setCity( $city): VisitEntity
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return VisitEntity
     */
    public function setRegion( $region): VisitEntity
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return VisitEntity
     */
    public function setCountry( $country): VisitEntity
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return VisitEntity
     */
    public function setLat( $lat): VisitEntity
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLon(): string
    {
        return $this->lon;
    }

    /**
     * @param string $lon
     * @return VisitEntity
     */
    public function setLon( $lon): VisitEntity
    {
        $this->lon = $lon;
        return $this;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @param int $day
     * @return VisitEntity
     */
    public function setDay(int $day): VisitEntity
    {
        $this->day = $day;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @param int $month
     * @return VisitEntity
     */
    public function setMonth(int $month): VisitEntity
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return VisitEntity
     */
    public function setYear(int $year): VisitEntity
    {
        $this->year = $year;
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