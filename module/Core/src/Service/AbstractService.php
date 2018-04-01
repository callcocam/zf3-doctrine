<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 15:22
 */

namespace Core\Service;


use Admin\Entity\EmpresaEntity;
use Admin\Entity\UserEntity;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Hydrator\ClassMethods;

abstract class AbstractService extends Utils
{
    protected $em;
    protected $entity;

    /**
     * @var array
     */
    protected $Result = [
        'result' => FALSE,
        'type' => "danger",
        'msg' => "",
        'entity' => null
    ];

    /**
     * AbstractService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $data
     * @return array
     * @throws ORMException
     */
    public function save(Array $data = [])
    {

        if (isset($data['empresa'])) {
            if (!(int)$data['empresa']) {
                $data['empresa'] = 1;
            }
            $data['empresa'] = $this->em->getReference(EmpresaEntity::class, $data['empresa']);
        }
        if (isset($data['author'])) {
             $data['author'] = $this->em->getReference(UserEntity::class, $data['author']);
        }
        if (isset($data['created_at']) && $data['created_at']) {
            $data['created_at'] = new \DateTime ($this->Data($data['created_at']));
        } else {
            $data['created_at'] = new \DateTime (date("Y-m-d"));
        }

        if (isset($data['updated_at']) && $data['updated_at']) {

            $data['updated_at'] = new \DateTime ($this->Data($data['updated_at']));
        } else {
            $data['updated_at'] = new \DateTime ();
        }
        try {
            if (isset($data['id']) && $data['id']) {
                $d = $this->em->getRepository($this->entity)->find($data['id']);
                if ($d) {
                    $entity = $this->em->getReference($this->entity, $data['id']);
                    $hydrate = new ClassMethods();
                    $hydrate->hydrate($data, $entity);
                } else {
                    $entity = new $this->entity($data);
                }
                $this->em->persist($entity);
                return $this->getResult($entity, $data['id'], "Registro atualizado com sucesso");

            } else {
                $entity = new $this->entity($data);
                $this->em->persist($entity);
                return $this->getResult($entity, 1, "Registro cadastrado com sucesso");
            }


        } catch (ORMException $ORMException) {
            //$this->em->getConfiguration()->setSQLLogger(new EchoSQLLogger());
            $this->Result['msg'] = $ORMException->getMessage();
        } catch (UniqueConstraintViolationException $violationException) {
            $this->Result['msg'] = $violationException->getMessage();
        }

        return $this->Result;
    }

    public function remove(Array $data = array())
    {
        $entity = $this->em->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->em->remove($entity);
            return $this->getResult($entity, 1, "Registro excluido com sucesso");
        }
        $this->Result['msg'] = "Não foi possivel excluir o registro";
        return $this->Result;

    }

    public function state($id, $valor)
    {
        //atualiza o valor pago no cabecalho da venda
        $qb = $this->em->createQueryBuilder();
        $q = $qb->update($this->entity, 'u')
            ->set('u.status', '?1')
            ->where("u.id= ?2")
            ->setParameter(1, $valor)
            ->setParameter(2, $id)
            ->getQuery();
        $p = $q->execute();
        return $p;

    }

    protected function getResult($entity, $result = 1, $message = "Registro cadastrado com sucesso")
    {
        try {

            $this->em->flush();
            $this->Result = [
                'result' => $result,
                'type' => "success",
                'msg' => $message,
                'entity' => $entity
            ];
            return $this->Result;
        } catch (ORMException $ORMException) {
            //$this->em->getConfiguration()->setSQLLogger(new EchoSQLLogger());
            $this->Result['type'] = 'error';
            $this->Result['result'] = false;
            $this->Result['msg'] = $ORMException->getMessage();
            return $this->Result;
        } catch (UniqueConstraintViolationException $violationException) {
            $this->Result['type'] = 'error';
            $this->Result['result'] = false;
            $this->Result['msg'] = $violationException->getMessage();
            return $this->Result;
        }

    }

    public function encryptPassword($email, $password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $email, 10000, strlen($password) * 2));
    }
}