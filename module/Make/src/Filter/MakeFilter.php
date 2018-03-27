<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 16:45
 */

namespace Make\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Make\Entity\MakeEntity;
use Zend\InputFilter\InputFilter;

class MakeFilter extends AbstractFilter
{

    /**
     * FilterInterface constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getInputFilter()
    {
        $this->inputFilter = new InputFilter();

        ########################### name ####################
        $this->inputFilter->add([
            'name'=>'name',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('name'),
                $this->StringLength('name')
            ]
        ]);
        ########################### route ####################
        $this->inputFilter->add([
            'name'=>'route',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('route'),
                $this->NotEmpty('route')
            ]
        ]);
        ########################### controller ####################
        $this->inputFilter->add([
            'name'=>'controller',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('controller'),
                $this->NotEmpty('controller'),
                $this->getInputFilterSpecification(MakeEntity::class,['id','controller'],"Controlador")
            ]
        ]);
        ########################### alias ####################
        $this->inputFilter->add([
            'name'=>'alias',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('alias'),
                $this->NotEmpty('alias')
            ]
        ]);
        return parent::getInputFilter();
    }


}