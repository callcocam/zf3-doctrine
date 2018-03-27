<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class ConfigFilter extends AbstractFilter
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
            'name' => 'conf_name',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Nome'),
                $this->StringLength('Nome')
            ]
        ]);
        ########################### conf_value ####################
        $this->inputFilter->add([
            'name' => 'conf_value',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Valor'),
                $this->StringLength('Valor')
            ]
        ]);
        ########################### conf_type ####################
        $this->inputFilter->add([
            'name' => 'conf_type',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('Tipo'),
                $this->StringLength('Tipo')
            ]
        ]);

        return parent::getInputFilter();
    }


}