<?php

namespace Sisc\Entity;

use Core\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * SolicitacoeEntity
 *
 * @ORM\Table(name="solicitacoe")
 * @ORM\Entity(repositoryClass="Sisc\Repository\SolicitacoeRepository")
 */
class SolicitacoeEntity extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
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
     * @ORM\ManyToOne(targetEntity="Sisc\Entity\ClientEntity")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var int|null
     *
     * @ORM\Column(name="protocolo", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $protocolo;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Sisc\Entity\SolicitacoeEntity")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var int
     *
     * @ORM\Column(name="return_form", type="integer", precision=0, scale=0, nullable=false, options={"default"="1","comment"="1-[E]mail - 2-[F]ax - [C]orreio"}, unique=false)
     */
    private $returnForm = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prevision_reply_date", type="datetime", precision=0, scale=0, nullable=true, options={"comment"="data prevista para a solicitação ser respondida"}, unique=false)
     */
    private $previsionReplyDate;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="prolongation_by", referencedColumnName="id")
     */
    private $prolongationBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prolongation_date", type="datetime", precision=0, scale=0, nullable=true, options={"comment"="Indica se a data prevista para resposta foi prorrogada"}, unique=false)
     */
    private $prolongationDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prolongation_desc", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $prolongationDesc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reply_date", type="datetime", precision=0, scale=0, nullable=true, options={"comment"="data da resposta da solicitação"}, unique=false)
     */
    private $replyDate;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="reception_by", referencedColumnName="id")
     */
    private $receptionBy;

    /**
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Admin\Entity\UserEntity")
     * @ORM\JoinColumn(name="reply_by", referencedColumnName="id")
     */
    private $replyBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reply", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $reply;

    /**
     * @var int|null
     *
     * @ORM\Column(name="instancy", type="integer", precision=0, scale=0, nullable=true, options={"default"="1","comment"="1-inicial; 2-seguimento; 3-ultima"}, unique=false)
     */
    private $instancy = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", precision=0, scale=0, nullable=true, options={"default"="1","comment"="1 - aberto; 2 - em tramitacao; 3 - negado; 4 - respondido;"}, unique=false)
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
     * @param int|null $empresa
     *
     * @return SolicitacoeEntity
     */
    public function setEmpresa($empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa.
     *
     * @return int|null
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set client.
     *
     * @param int|null $client
     *
     * @return SolicitacoeEntity
     */
    public function setClient($client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client.
     *
     * @return int|null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set protocolo.
     *
     * @param int|null $protocolo
     *
     * @return SolicitacoeEntity
     */
    public function setProtocolo($protocolo = null)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get protocolo.
     *
     * @return int|null
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set parent.
     *
     * @param int|null $parent
     *
     * @return SolicitacoeEntity
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return int|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set returnForm.
     *
     * @param int $returnForm
     *
     * @return SolicitacoeEntity
     */
    public function setReturnForm($returnForm)
    {
        $this->returnForm = $returnForm;

        return $this;
    }

    /**
     * Get returnForm.
     *
     * @return int
     */
    public function getReturnForm()
    {
        return $this->returnForm;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return SolicitacoeEntity
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set previsionReplyDate.
     *
     * @param \DateTime|null $previsionReplyDate
     *
     * @return SolicitacoeEntity
     */
    public function setPrevisionReplyDate($previsionReplyDate = null)
    {
        $this->previsionReplyDate = $previsionReplyDate;

        return $this;
    }

    /**
     * Get previsionReplyDate.
     *
     * @return \DateTime|null
     */
    public function getPrevisionReplyDate()
    {
        return $this->previsionReplyDate;
    }

    /**
     * Set prolongationBy.
     *
     * @param int|null $prolongationBy
     *
     * @return SolicitacoeEntity
     */
    public function setProlongationBy($prolongationBy = null)
    {
        $this->prolongationBy = $prolongationBy;

        return $this;
    }

    /**
     * Get prolongationBy.
     *
     * @return int|null
     */
    public function getProlongationBy()
    {
        return $this->prolongationBy;
    }

    /**
     * Set prolongationDate.
     *
     * @param \DateTime|null $prolongationDate
     *
     * @return SolicitacoeEntity
     */
    public function setProlongationDate($prolongationDate = null)
    {
        $this->prolongationDate = $prolongationDate;

        return $this;
    }

    /**
     * Get prolongationDate.
     *
     * @return \DateTime|null
     */
    public function getProlongationDate()
    {
        return $this->prolongationDate;
    }

    /**
     * Set prolongationDesc.
     *
     * @param string|null $prolongationDesc
     *
     * @return SolicitacoeEntity
     */
    public function setProlongationDesc($prolongationDesc = null)
    {
        $this->prolongationDesc = $prolongationDesc;

        return $this;
    }

    /**
     * Get prolongationDesc.
     *
     * @return string|null
     */
    public function getProlongationDesc()
    {
        return $this->prolongationDesc;
    }

    /**
     * Set replyDate.
     *
     * @param \DateTime|null $replyDate
     *
     * @return SolicitacoeEntity
     */
    public function setReplyDate($replyDate = null)
    {
        $this->replyDate = $replyDate;

        return $this;
    }

    /**
     * Get replyDate.
     *
     * @return \DateTime|null
     */
    public function getReplyDate()
    {
        return $this->replyDate;
    }

    /**
     * Set receptionBy.
     *
     * @param int|null $receptionBy
     *
     * @return SolicitacoeEntity
     */
    public function setReceptionBy($receptionBy = null)
    {
        $this->receptionBy = $receptionBy;

        return $this;
    }

    /**
     * Get receptionBy.
     *
     * @return int|null
     */
    public function getReceptionBy()
    {
        return $this->receptionBy;
    }

    /**
     * Set replyBy.
     *
     * @param int|null $replyBy
     *
     * @return SolicitacoeEntity
     */
    public function setReplyBy($replyBy = null)
    {
        $this->replyBy = $replyBy;

        return $this;
    }

    /**
     * Get replyBy.
     *
     * @return int|null
     */
    public function getReplyBy()
    {
        return $this->replyBy;
    }

    /**
     * Set reply.
     *
     * @param string|null $reply
     *
     * @return SolicitacoeEntity
     */
    public function setReply($reply = null)
    {
        $this->reply = $reply;

        return $this;
    }

    /**
     * Get reply.
     *
     * @return string|null
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * Set instancy.
     *
     * @param int|null $instancy
     *
     * @return SolicitacoeEntity
     */
    public function setInstancy($instancy = null)
    {
        $this->instancy = $instancy;

        return $this;
    }

    /**
     * Get instancy.
     *
     * @return int|null
     */
    public function getInstancy()
    {
        return $this->instancy;
    }

    /**
     * Set status.
     *
     * @param int|null $status
     *
     * @return SolicitacoeEntity
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return SolicitacoeEntity
     */
    public function setCreatedAt($createdAt)
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
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return SolicitacoeEntity
     */
    public function setUpdatedAt($updatedAt)
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
}
