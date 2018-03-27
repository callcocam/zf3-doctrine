<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 25/03/2018
 * Time: 23:38
 */

namespace Core\View\Helper;


use Zend\View\Helper\AbstractHelper;

class AclHelper extends AbstractHelper
{


    private $Acl;

    /**
     * AclHelper constructor.
     * @param $Acl
     */
    public function __construct($Acl)
    {

        $this->Acl = $Acl;
    }



    public function getAcl()
    {
        return $this->Acl;
    }
}