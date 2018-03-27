<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;

class GalleryFilter extends AbstractFilter
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
//        $this->inputFilter->add([
//            'name'=>'name',
//            'required'=>true,
//            'filters'=>$this->filters(),
//            'validators'=>[
//                $this->NotEmpty('name'),
//                $this->StringLength('name')
//            ]
//        ]);

        ########################### controller ####################
//        $this->inputFilter->add([
//            'name'=>'controller',
//            'required'=>true,
//            'filters'=>$this->filters(),
//            'validators'=>[
//                $this->StringLength('controller'),
//                $this->NotEmpty('controller'),
//                $this->getInputFilterSpecification(Make::class,['id','controller'],"Controlador")
//            ]
//        ]);

        return parent::getInputFilter();
    }


}