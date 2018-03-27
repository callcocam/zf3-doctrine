<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class MenuFilter extends AbstractFilter
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
                $this->NotEmpty('route'),
                $this->StringLength('route')
            ]
        ]);

        ########################### controller ####################
        $this->inputFilter->add([
            'name'=>'route',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('controller'),
                $this->StringLength('controller')
            ]
        ]);
        ########################### ordem ####################
        $this->inputFilter->add([
            'name'=>'ordem',
            'required'=>false,
            'filters'=>$this->filters()
        ]);
        ########################### parent ####################
        $this->inputFilter->add([
            'name'=>'parent',
            'required'=>false,
            'filters'=>$this->filters()
        ]);

        ########################### alias ####################
        $this->inputFilter->add([
            'name'=>'alias',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('alias'),
                $this->StringLength('alias')
            ]
        ]);

        return parent::getInputFilter();
    }


}