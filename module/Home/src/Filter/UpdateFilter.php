<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 02/05/2018
 * Time: 14:31
 */

namespace Home\Filter;


use Core\Filter\AbstractFilter;
use Sisc\Entity\ClientEntity;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Identical;

class UpdateFilter extends AbstractFilter
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
        if (!$this->inputFilter):
            $this->inputFilter = new InputFilter();

            $this->inputFilter->add([
                'name'=>'password',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->RecordExists(ClientEntity::class,'password',"Senha Atual"),
                    $this->StringLength('Senha Atual'),
                    $this->NotEmpty('Senha Atual'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'new_password',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Nova Senha'),
                    $this->NotEmpty('Nova Senha'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'rep_password',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Confirmação de Senha'),
                    $this->NotEmpty('Confirmação de Senha'),
                    [
                        'name'=>Identical::class,
                        'options' => [
                            'token' => 'new_password',
                            'messages' => [
                                 Identical::NOT_SAME => "Campo [Confirmar Senha] deve ser igual ao campo [Senha]",
                            ],
                        ]

                    ]
                ]
            ]);
        endif;
        return parent::getInputFilter();
    }

}