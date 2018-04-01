<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControleEstoque\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class ProductFilter extends AbstractFilter
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
        ########################### costs ####################
        $this->inputFilter->add([
            'name'=>'costs',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('name'),
                $this->StringLength('name')
            ]
        ]);

        ########################### price ####################
        $this->inputFilter->add([
            'name'=>'price',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('name'),
                $this->StringLength('name')
            ]
        ]);

        ########################### email ####################
        $this->inputFilter->add([
            'name' => 'parent',
            'required' => false,
            'filters' => [],
            'validators' => [

            ]
        ]);

        return parent::getInputFilter();
    }


}