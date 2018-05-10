<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Repository;


use Admin\Entity\EmpresaEntity;
use Doctrine\ORM\EntityRepository;

class EmpresaRepository extends EntityRepository
{

    /**
     * @return array|null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setCompany(){
        $Empress = parent::findOneBy(['assets'=>SIS]);
        if(!$Empress){
            $expressEntity = new EmpresaEntity();
            $expressEntity->setEmail("contato@sigasmart.com.br")
                ->setPhone("(48)3535-1603")
                ->setStreet("Oscar de oliveira lopes")
                ->setAssets(SIS)
                ->setZip("88950-000")
                ->setNumber("355")
                ->setState("SC")
                ->setDistrict("Bela Vista")
                ->setCity("Jacinto Machado")
                ->setCountry("Brasil")
                ->setFantasia(strtoupper(SIS))
                ->setSocial(strtoupper(SIS))
                ->setDistrict("Sistema Inteligente de Gerenciamento e Admistração!")
                ->setDescription("Sistema Inteligente de Gerenciamento e Admistração!")
                ->setCover("/dist/uploads/images/no_image.jpg")
                ->setGoogle("114670982115068448665")
                ->setFacebook("claudio.coelho.175")
                ->setTwitter("callcocam")
                ->setLatitude("-29.0003557")
                ->setLongetude("-49.7612579")
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());
            $this->getEntityManager()->persist($expressEntity);
            $this->getEntityManager()->flush();
            $Empress = $expressEntity->toArray();
        }
        /** @var EmpresaEntity $Empress */
        return $Empress;
    }

    public function getCompany(){
        $Empress = parent::findOneBy(['assets'=>SIS]);
        if(!$Empress){
            $Empress = $this->setCompany();
        }
        return $Empress;
    }
    public function getById(){
        $Empress = parent::findOneBy(['assets'=>SIS]);
        return $Empress->getId();
    }


}