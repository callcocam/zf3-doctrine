<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 03/05/2018
 * Time: 00:55
 */

namespace Home\Service;


use Admin\Entity\UserEntity;
use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Sisc\Entity\ClientEntity;
use Sisc\Entity\MovimentEntity;
use Sisc\Entity\SolicitacoeEntity;

class ResponderService extends AbstractService
{

    public function __construct(EntityManager $em)
    {
        $this->entity = "Sisc\\Entity\\SolicitacoeEntity";
        parent::__construct($em);
    }

    /**
     * @param array $data
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Array $data = [])
    {

        if(isset($data['client'])){
            $data['client'] = $this->getReference(ClientEntity::class, $data['client']);
        }

        if(isset($data['parent']) && $data['parent']) {
            $data['parent'] =$this->getReference(SolicitacoeEntity::class, $data['parent']);
        }
        else{
            $data['parent'] = NULL;
        }
        if($data['reception_by']){
            $data['reception_by'] = $this->getReference(UserEntity::class, $data['reception_by']);
        }
        if(isset($data['replyDate'])){
            $data['replyDate'] =  new \DateTime(date('Y-m-d'));
        }
        if(isset($data['reply_by'])){
            $data['reply_by'] = $this->getReference(UserEntity::class,$data['reply_by']);
        }
        if(!isset($data['id'])){
            $data['protocolo'] = date('YmdHis');
            $data['prevision_reply_date'] = new \DateTime(date('Y-m-d', strtotime(' + 10 days')));
        }
        $result =  parent::save($data);
        if($result['result']){

            $param = $data['parent']->getId();

            /**
             * @var $Movement MovimentEntity
             */

            $Movement = $this->em->getRepository(MovimentEntity::class)->findOneBy(['solicitacion'=>$param]);
            $Actual = (int)$Movement->getInstacia();
            $Actual++;

            $this->em->createQueryBuilder()->update(MovimentEntity::class, 'u')
                ->set('u.status', ':status')
                ->set('u.instacia', ':instacia')
                ->where('u.solicitacion =:solicitacion')
                ->setParameter('status', 1)
                ->setParameter('instacia', $Actual)
                ->setParameter('solicitacion', $param)->getQuery()->getResult();

            $this->em->createQueryBuilder()->update($this->entity, 'u')
                ->set('u.status', ':status')
                ->where('u.id =:id')
                ->setParameter('status', 3)
                ->setParameter('id', $param)->getQuery()->getResult();

            $this->em->createQueryBuilder()->update($this->entity, 'u')
                ->set('u.instancy', ':instancy')
                ->where('u.id =:id')
                ->setParameter('instancy', $Actual)
                ->setParameter('id', $result['id'])->getQuery()->getResult();
        }

        return $result;
    }


}