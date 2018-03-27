<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 15:19
 */

namespace Core\Entity;


use Zend\Hydrator\ClassMethods;

abstract class AbstractEntity
{


    /**
     * AbstractEntity constructor.
     * @param array $optinos
     */
    public function __construct($optinos=array()) {

        $hydrate=new ClassMethods();
        $hydrate->hydrate($optinos, $this);


    }

    /**
     * @return array
     */
    public function toArray()
    {
        $hydrate=new ClassMethods();
        if(isset($this->parent))
            $parent = $this->parent->getId();
        else
            $parent = false;
        return  $hydrate->extract($this);
    }

}