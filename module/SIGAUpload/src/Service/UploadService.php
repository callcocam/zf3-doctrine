<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace SIGAUpload\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class UploadService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="SIGAUpload\Entity\UploadEntity";
        parent::__construct($em);
    }
    public function save( Array $data = [] )
    {
        if(is_null($data['name'])){
            $data['name']= date("Y-m-d H:i");
        }

        return parent::save($data); // TODO: Change the autogenerated stub
    }
}