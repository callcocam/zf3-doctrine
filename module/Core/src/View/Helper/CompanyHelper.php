<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 01/05/2018
 * Time: 23:59
 */

namespace Core\View\Helper;


use Admin\Entity\EmpresaEntity;
use Zend\View\Helper\AbstractHelper;

class CompanyHelper extends AbstractHelper
{

    /**
     * @var EmpresaEntity
     */
    private $entity;

    public function __construct(EmpresaEntity $entity)
    {
          $this->entity = $entity;
    }
    public function __invoke()
    {
        return $this->entity->toArray();
    }
}