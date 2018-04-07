<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class ProdutoFilter extends AbstractFilter
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


        ########################### parent ####################
        $this->inputFilter->add([
            'name' => 'parent',
            'required' => false,
            'filters' => $this->filters(),
            'validators' => [
                $this->StringLength('Variação'),

            ]
        ]);
        ########################### name ####################
        $this->inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Nome/Descrição'),
                $this->StringLength('Nome/Descrição')
            ]
        ]);

        ########################### categorie ####################
        $this->inputFilter->add([
            'name' => 'categorie',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Categoria'),
                $this->StringLength('Categoria')
            ]
        ]);

        ########################### brand ####################
        $this->inputFilter->add([
            'name' => 'brand',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Marca'),
                $this->StringLength('Marca')
            ]
        ]);

        return parent::getInputFilter();
    }


}