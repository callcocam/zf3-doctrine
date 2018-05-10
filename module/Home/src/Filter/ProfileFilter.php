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

class ProfileFilter extends AbstractFilter
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
                'name'=>'name',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Nome Completo'),
                    $this->NotEmpty('Nome Completo'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'document',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->NoRecordExists(ClientEntity::class,['id','document'],'Cpf/Cnpj'),
                    $this->StringLength('Documento'),
                    $this->NotEmpty('Documento')
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'email',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->NoRecordExists(ClientEntity::class,['id','email']),
                    $this->StringLength('E-Mail'),
                    $this->NotEmpty('E-Mail'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'phone',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Telefone'),
                    $this->NotEmpty('Telefone'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'zip',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Cep'),
                    $this->NotEmpty('Cep'),
                ]
            ]);


            $this->inputFilter->add([
                'name'=>'city',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Cidade'),
                    $this->NotEmpty('Cidade'),
                ]
            ]);


            $this->inputFilter->add([
                'name'=>'street',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Endereço'),
                    $this->NotEmpty('Endereço'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'district',
                'required'=>true,
                'filters'=>$this->filters(),
                'validators'=>[
                    $this->StringLength('Bairro'),
                    $this->NotEmpty('Bairro'),
                ]
            ]);

            $this->inputFilter->add([
                'name'=>'complement',
                'required'=>false,
                'filters'=>$this->filters()
            ]);

            $this->inputFilter->add([
                'name'=>'state',
                'required'=>false,
                'filters'=>$this->filters()
            ]);


        endif;
        return parent::getInputFilter();
    }

}