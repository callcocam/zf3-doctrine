<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 21/03/2018
 * Time: 00:00
 */

namespace Core\Table\Table;


class ButtonsConfig
{

    protected $name;
    protected $vars = ['id'];
    protected $attrs = ['class' => 'btn btn-success btn-xs btn-flat','id'=>'editar'];
    protected $status = [1];

    protected $icone = "fa fa-pencil";

    protected $btn = [];

    private $Route;

    private $Controller;
    /**
     * @var array
     */
    private $Params;

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
     * @return ButtonsConfig
     */
    public function add($name){
        $this->btn[$name] = [
            'atrrs' => $this->getAttrs(),
            'status' => $this->getStatus(),
            'vars' => $this->getVars(),
            'ico' => $this->getIcone(),
        ];
        return $this;
    }

    public function setLink($Url, $action ="create", $id = "%s"){
        $this->btn[$this->name]['href'] = $Url(sprintf('%s/default', $this->Route), [
            'controller' => $this->Controller,
            'action' => $action,
            'id' => $id,
        ]);
        return $this;
    }

    /**
     * @param mixed $Controller
     * @return ButtonsConfig
     */
    public function setController($Controller)
    {
        $this->Controller = $Controller;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->Controller;
    }

    /**
     * @param mixed $Route
     * @return ButtonsConfig
     */
    public function setRoute($Route)
    {
        $this->Route = $Route;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->Route;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->Params;
    }

    /**
     * @param array $Params
     * @return ButtonsConfig
     */
    public function setParams(array $Params)
    {
        $this->Params = $Params;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * @param string $icone
     * @return ButtonsConfig
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ButtonsConfig
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     * @return ButtonsConfig
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * @param array $attrs
     * @return ButtonsConfig
     */
    public function setAttrs(array $attrs)
    {
        $this->attrs = array_merge($this->attrs,$attrs);
        return $this;
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $status
     * @return ButtonsConfig
     */
    public function setStatus(array $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getBtn()
    {
        return $this->btn;
    }


}