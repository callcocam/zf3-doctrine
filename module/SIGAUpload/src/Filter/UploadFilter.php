<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace SIGAUpload\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class UploadFilter extends AbstractFilter
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