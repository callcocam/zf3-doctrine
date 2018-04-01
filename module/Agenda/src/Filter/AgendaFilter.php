<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class AgendaFilter extends AbstractFilter
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
            'name'=>'title',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('Titulo'),
                $this->StringLength('Titulo')
            ]
        ]);

        $this->inputFilter->add([
            'name'=>'client',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('Cliente'),
                $this->StringLength('Cliente')
            ]
        ]);

        $this->inputFilter->add([
            'name'=>'author',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('Responsavel'),
                $this->StringLength('Responsavel')
            ]
        ]);

        $this->inputFilter->add([
            'name'=>'event_id',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('Categoria'),
                $this->StringLength('Categoria')
            ]
        ]);

        $this->inputFilter->add([
            'name'=>'start',
            'required'=>true,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->NotEmpty('Data Inicial'),
                $this->StringLength('Data Inicial')
            ]
        ]);


        return parent::getInputFilter();
    }


}