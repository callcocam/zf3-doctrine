<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 20:31
 */

namespace Core\Table\Table;


use Core\Table\Table\Exception\LogicException;
use Zend\Debug\Debug;

class HeadersConfig
{

    /**
     * @var array Definition of headers
     */
    protected $defaultHeaders = [
        'id' =>     ['tableAlias' => 'p','title' => 'check-all', 'width' => '50',"sortable"=>false,"ordering"=>1],
       // 'name' =>        ['tableAlias' => 'p','title' => 'Name',"order"=>2],
        'createdAt' =>      ['tableAlias' => 'p','title' => 'Data', 'width' => 210,"order"=>4],
        'status' =>      ['tableAlias' => 'p','title' => 'Active', 'width' => 150,"sortable"=>false,"order"=>5],
    ];
    /**
     * @var array Definition of headers
     */
    protected $headers = [];

    public function add($name,array $header , $position){
        $this->headers=[];
        foreach ($this->defaultHeaders as $index => $defaultHeader) {
            $this->headers[$index] = $defaultHeader;
            if($position == $index){
                $this->headers[$name] = $header;
            }
         }
         $this->defaultHeaders = $this->headers;
        return $this;
    }

    public function getHeaders(){
        if(!$this->headers){
            $this->headers = $this->defaultHeaders;
        }
        return $this->headers;
    }

    public function getHeader($name){
        if (!isset($this->headers[$name])) {
            throw new LogicException("name {$name} not found!");
        }
        return $this->headers[$name];
    }

    public function remove($name){
        if (!isset($this->headers[$name])) {
            throw new LogicException("name {$name} not found!");
        }
        unset($this->headers[$name]);
        return $this;
    }
}