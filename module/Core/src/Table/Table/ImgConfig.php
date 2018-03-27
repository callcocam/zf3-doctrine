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

    protected $name;
    protected $vars = ['id'];
    //protected $attrs = ['class'=>'img-circle','style'=>'width: 100%; display: block;'];
    protected $attrs = ['class'=>''];
    protected $thumbnail = true;

    protected $Img;

    private $Route;

    private $Controller;

    /**
     * ButtonsConfig constructor.
     * @param $Route
     * @param $Controller
     */
    public function __construct($Route, $Controller, $Params = [])
    {
        $this->Route = $Route;
        $this->Controller = $Controller;
        $this->Params = $Params;
    }

    /**
     * @param $name
     * @return ImgConfig
     */
    public function add($name){
        $this->Img = [
            'atrrs' => $this->getAttrs(),
            'status' => $this->getStatus(),
            'vars' => $this->getVars()
        ];
        return $this;
    }

    public function setLink($Url, $action ="file"){
        $this->Img['base'] = $Url(sprintf('%s/default', $this->Route), [
            'controller' => $this->Controller,
            'action' => $action
        ]);
        return $this;
    }
}