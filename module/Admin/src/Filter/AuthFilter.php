<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Filter;


use Core\Filter\AbstractFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;

class AuthFilter extends AbstractFilter
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

        ########################### email ####################
        $this->inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('name'),
                $this->StringLength('name'),
                //$this->EmailValitator("email")
            ]
        ]);

        ########################### password ####################
        $this->inputFilter->add([
            'name' => 'password',
            'required' => true,
            'filters' => $this->filters(),
            'validators' => [
                $this->NotEmpty('password'),
                $this->StringLength('password')
            ]
        ]);

        ########################### password ####################
        $this->inputFilter->add([
            'name' => 'remember_me',
            'required' => false,
            'validators' => [
                [
                    'name' => InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ]
                ]
            ]
        ]);
//        ########################### redirect_url ####################
//        $this->inputFilter->add([
//            'name' => 'redirect_url',
//            'required' => false,
//            'filters' => $this->filters(),
//            'validators' => [
//                [
//                    //$this->StringLength('redirect_url', 0, 2048)
//                ],
//            ],
//        ]);

        return parent::getInputFilter();
    }


}