<?php

namespace Admin\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Core\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\UserRepository")
 * @ORM\Entity
 */
class UserEntity extends AbstractEntity
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
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\EmpresaEntity")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=40, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=40, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=150, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=100, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="google", type="string", length=100, nullable=true)
     */
    private $google;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=false, options={"default"="/dist/uploads/images/no_image.jpg"})
     */
    private $cover = '/dist/uploads/images/no_image.jpg';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pwd_reset_token", type="string", length=255, nullable=true, options={"default"=null})
     */
    private $pwdResetToken;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pwd_reset_token_creation_date", type="datetime", nullable=true, options={"default"=null})
     */
    private $pwdResetTokenCreationDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_active", type="string", length=255, nullable=true)
     */
    private $userActive;

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
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\RoleEntity")
     * @ORM\JoinColumn(name="access", referencedColumnName="id")
     */
    private $access;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set empresa.
     *
     * @param int $empresa
     *
     * @return UserEntity
     */
    public function setEmpresa( $empresa )
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa.
     *
     * @return int
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return UserEntity
     */
    public function setFirstName( $firstName )
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return UserEntity
     */
    public function setLastName( $lastName )
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return UserEntity
     */
    public function setEmail( $email )
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebook.
     *
     * @param string $facebook
     *
     * @return UserEntity
     */
    public function setFacebook( $facebook )
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook.
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter.
     *
     * @param string $twitter
     *
     * @return UserEntity
     */
    public function setTwitter( $twitter )
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter.
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set google.
     *
     * @param string $google
     *
     * @return UserEntity
     */
    public function setGoogle( $google )
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google.
     *
     * @return string
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return UserEntity
     */
    public function setDescription( $description )
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cover.
     *
     * @param string $cover
     *
     * @return UserEntity
     */
    public function setCover( $cover )
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return UserEntity
     */
    public function setPassword( $password )
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getPwdResetToken()
    {
        return $this->pwdResetToken;
    }

    /**
     * @param null|string $pwdResetToken
     * @return UserEntity
     */
    public function setPwdResetToken( $pwdResetToken )
    {
        $this->pwdResetToken = $pwdResetToken;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPwdResetTokenCreationDate()
    {
        return $this->pwdResetTokenCreationDate;
    }

    /**
     * @param \DateTime $pwdResetTokenCreationDate
     * @return UserEntity
     */
    public function setPwdResetTokenCreationDate( $pwdResetTokenCreationDate )
    {
        $this->pwdResetTokenCreationDate = $pwdResetTokenCreationDate;
        return $this;
    }


    /**
     * Set userActive.
     *
     * @param string|null $userActive
     *
     * @return UserEntity
     */
    public function setUserActive( $userActive = null )
    {
        $this->userActive = $userActive;

        return $this;
    }

    /**
     * Get userActive.
     *
     * @return string|null
     */
    public function getUserActive()
    {
        return $this->userActive;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return UserEntity
     */
    public function setStatus( $status )
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return UserEntity
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return UserEntity
     */
    public function setCreatedAt( $createdAt )
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set access.
     *
     * @param string $access
     *
     * @return UserEntity
     */
    public function setAccess( $access )
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access.
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }
}
