<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 19/03/2018
 * Time: 22:36
 */

namespace Core\Table;


use Zend\Debug\Debug;

class ValuesOfItemPerPage extends AbstractElement
{
    /**
     * @var label do option
     */
    protected $statusLabel;
    /**
     * @var $statusAction estado do status ex 1,2,3
     */
    protected $statusAction;

    /**
     * @var string selected
     */
    protected $statusSelect = "";
    /**
     * @var $statusValue value option
     */
    protected $statusValue;
    /**
     * @var string $class
     */
    protected $class = "itemPerPage form-control input-lg";

    /**
     * Array of options
     *
     * @param $Value
     * @param $Label
     * @param $Status
     * @throws \Exception
     */
    public function __construct($Value, $Label,$Status)
    {

        $this->statusAction = $Status;
        $this->statusLabel = $Label;
        $this->statusValue = $Value;
    }
    /**
     * Set reference to table
     *
     * @param $table
     * @return void|\Core\Table\AbstractCommon
     */
    public function setTable($table)
    {
        $this->table = $table;
    }


    protected function initRendering()
    {
        if((int)$this->statusAction === (int)$this->statusValue):
            $this->statusSelect = "selected";
        endif;

    }

    /**
     * Rendering header element
     *
     * @return string
     */
    public function render()
    {
        $this->initRendering();
        return sprintf("<option %s value='%s'>%s</option>",$this->statusSelect, $this->statusValue, $this->statusLabel);
    }

    public function getClass(){
        return $this->class;
    }

}