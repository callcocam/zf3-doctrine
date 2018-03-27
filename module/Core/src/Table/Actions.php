<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 19/03/2018
 * Time: 14:29
 */

namespace Core\Table;


use Zend\Debug\Debug;

class Actions extends AbstractElement
{
    /**
     * Type of button pode ser um a, button
     *
     * @var string
     */
    protected $actionType;

    /**
     * Name of button
     *
     * @var string
     */
    protected $actionName;

    /**
     * Width of the button (block)
     *
     * @var string
     */
    protected $actionWidth;
    /**
     * Width of the button (block)
     *
     * @var string
     */
    protected $actionClass = "btn %s btn-lg btn-flat btn-block";
    /**
     * Title of button
     *
     * @var string
     */
    protected $actionTitle;

    /**
     * Table of options
     *
     * @var array
     */
    protected $options = [];

    protected $actionAttrs = [];

    protected $actionAction;

    protected $actionId;

    protected $actionLabel;

    protected $actionIcone;

    private $status;

    protected $actionState;


    /**
     * Array of options
     *
     * @param string $name
     * @param array $options
     * @param $status
     */
    public function __construct($name, $options = [],$status)
    {
        $this->name = $name;
        $this->setOptions($options);
        $this->status = $status;
    }

    /**
     * Set options like title, width, order
     *
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->actionState = (isset($options['state'])) ? $options['state'] : [];
        $this->actionAttrs = (isset($options['attrs'])) ? $options['attrs'] : [];
        $this->actionId = (isset($options['id'])) ? $options['id'] : '';
        $this->actionLabel = (isset($options['label'])) ? $options['label'] : 'label';
        $this->actionTitle = (isset($options['title'])) ? $options['title'] : '';
        $this->actionClass = (isset($options['attrs']['class'])) ? sprintf($this->actionClass, $options['attrs']['class']) : sprintf($this->actionClass,"");
        $this->actionWidth = (isset($options['width'])) ? $options['width'] : '';
        $this->actionType = (isset($options['type'])) ? $options['type'] : 'a';
        $this->actionIcone = (isset($options['ico'])) ? $options['ico'] : null;
        $this->actionAction = (isset($options['action'])) ? $options['action'] : 'index';
        return $this;
    }

    /**
     * @return string
     */
    public function getActionType(): string
    {
        return $this->actionType;
    }

    /**
     * @param string $actionType
     * @return Actions
     */
    public function setActionType(string $actionType): Actions
    {
        $this->actionType = $actionType;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     * @return Actions
     */
    public function setActionName(string $actionName): Actions
    {
        $this->actionName = $actionName;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionWidth(): string
    {
        return $this->actionWidth;
    }

    /**
     * @param string $actionWidth
     * @return Actions
     */
    public function setActionWidth(string $actionWidth): Actions
    {
        $this->actionWidth = $actionWidth;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionClass(): string
    {
        return $this->actionClass;
    }

    /**
     * @param string $actionClass
     * @return Actions
     */
    public function setActionClass(string $actionClass): Actions
    {
        $this->actionClass = $actionClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionTitle(): string
    {
        return $this->actionTitle;
    }

    /**
     * @param string $actionTitle
     * @return Actions
     */
    public function setActionTitle(string $actionTitle): Actions
    {
        $this->actionTitle = $actionTitle;
        return $this;
    }

    /**
     * @return array
     */
    public function getActionAttrs(): array
    {
        return $this->actionAttrs;
    }

    /**
     * @param array $actionAttrs
     * @return Actions
     */
    public function setActionAttrs(array $actionAttrs): Actions
    {
        $this->actionAttrs = $actionAttrs;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionAction()
    {
        return $this->actionAction;
    }

    /**
     * @param mixed $actionAction
     * @return Actions
     */
    public function setActionAction($actionAction)
    {
        $this->actionAction = $actionAction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param mixed $actionId
     * @return Actions
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionLabel()
    {
        return $this->actionLabel;
    }

    /**
     * @param mixed $actionLabel
     * @return Actions
     */
    public function setActionLabel($actionLabel)
    {
        $this->actionLabel = $actionLabel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionIcone()
    {
        return $this->actionIcone;
    }

    /**
     * @param mixed $actionIcone
     * @return Actions
     */
    public function setActionIcone($actionIcone)
    {
        $this->actionIcone = $actionIcone;
        return $this;
    }


    /**
     * Set reference to table
     *
     * @param $url
     * @return void|\Core\Table\AbstractCommon
     */
    public function addUrl($url)
    {
        $this->url = $url;
    }
    /**
     * Init header (like asc, desc, column name )
     */
    protected function initRendering($gerarBtn)
    {
        if ($this->actionWidth) {
            $this->addAttr('width', $this->actionWidth);
        }

        if($gerarBtn):
            if($this->actionAttrs):
                foreach ($this->actionAttrs as $key => $attr):
                    if($key =='href'):
                        $U = $this->url;
                        $attr= $U(sprintf('%s/default', $this->getTable()->Route),
                            array_filter([
                                'controller'=> $this->getTable()->Controller,
                                'action'=>$this->actionAction,
                                'id'=>$this->actionId,
                            ]));
                    endif;
                    if($key =='class'):
                        $attr = $this->actionClass;
                    endif;
                    $this->addAttr($key, $attr);
                endforeach;
            endif;
        endif;


    }

    /**
     * Rendering header element
     *
     * @return string
     */
    public function render()
    {
        $gerarBtn = false;
        foreach ($this->actionState as $item){
            if($item == $this->status){
                $gerarBtn = true;
            }
        }
        if($gerarBtn):
            $this->initRendering($gerarBtn);
            $render = $this->getActionLabel();
            $icone="";
            if($this->getActionIcone()){
                $icone = sprintf("<i class='%s'><i>",$this->getActionIcone());
            }
            return sprintf("<th><%s %s>%s %s</%s></th>",$this->getActionType(), $this->getAttributes(),$icone, $render,$this->getActionType());
        endif;
        return "";
    }
}