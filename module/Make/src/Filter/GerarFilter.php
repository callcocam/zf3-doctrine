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

class GerarFilter extends AbstractFilter
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
        return parent::getInputFilter();
    }


}