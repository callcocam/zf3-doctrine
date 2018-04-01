<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 21/03/2018
 * Time: 06:45
 */

namespace Core\Table\Table;


class ImgConfig
{
 protected $Img = [
        'vars'=>['id'=>'id','name'=>'name','createdAt'=>'createdAt'],
        'w'=>140,
        'h'=>140,
        'thumbnail'=>true,
    ];

    /**
     * @param array $value
     * @return ImgConfig
     */
    public function add(array $value){

        $this->Img = array_merge($this->Img, $value);
        return $this;
    }

    public function getConfig(){
        return $this->Img;
    }

}