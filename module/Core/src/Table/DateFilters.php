<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 13:12
 */

namespace Core\Table;


use Zend\View\Renderer\PhpRenderer;

class DateFilters extends AbstractElement
{
    protected $dateSearch ='Buscar Por Data';
    protected $start_date;
    protected $end_date;
    protected $dateFormatLong;

    /**
     * Array of options
     *
     * @param $start_date
     * @param $end_date
     */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @param PhpRenderer $view
     * @return DateFilters
     */
    public function setView(PhpRenderer $view)
    {
        $this->dateFormat = $view->getHelperPluginManager()->getRenderer();
        return $this;
    }


    /**
     *
     */
    protected function initRendering()
    {

         if(!empty($this->start_date) && !empty($this->start_date)):
            $start_date = date_create($this->start_date);
            $end_date = date_create($this->end_date);
            $this->dateSearch  = sprintf("%s - %s", date_format($start_date, 'd/m/Y'), date_format($end_date, 'd/m/Y'));
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
        return sprintf("<button type='button'  style='margin-right: 10px;' class='btn btn-default btn-lg pull-right' id='daterange-btn'>
                                        <span><i class='fa fa-calendar'></i> %s</span>
                                        <i class='fa fa-caret-down'></i>
                                    </button>",$this->dateSearch);
    }
}