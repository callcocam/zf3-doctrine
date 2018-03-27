<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 12:14
 */

namespace Core\Table;


class Search extends AbstractElement
{
    private $quickSearch = "";

    /**
     * Array of options
     *
     * @param $quickSearch
     */
    public function __construct($quickSearch)
    {

        $this->quickSearch = $quickSearch;
    }

    protected function initRendering()
    {

    }

    /**
     * Rendering header element
     *
     * @return string
     */
    public function render()
    {
        $this->initRendering();
        return sprintf("<input name='table_search' aria-controls='dataTable' class='quick-search form-control pull-right' placeholder='Search' type='text' value='%s'>
                                <div class='input-group-btn'>
                                    <button type='submit' class='btn btn-default'><i class='fa fa-search'></i></button>
                                </div>",$this->quickSearch);
    }
}