<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements
    TableOptionsInterface,
    DataTableInterface,
    RenderInterface,
    PaginatorInterface
{

    /**
     * Name of table
     * @var null | string
     */
    protected $name = '';

    /**
     * Show or hide pagination view
     * @var boolean
     */
    protected $showPagination = true;

    /**
     * Show or hide status view
     * @var boolean
     */
    protected $showStatusFilters = true;

    /**
     * Show or hide quick search view
     * @var boolean
     */
    protected $showQuickSearch = false;


    /**
     * Show or hide item per page view
     * @var boolean
     */
    protected $showItemPerPage = true;

    /**
     * @todo item and default count per page
     * Default value for item count per page
     * @var int
     */
    protected $itemCountPerPage = 10;

    /**
     * Flag to show row with filters (for each column)
     * @var boolean
     */
    protected $showColumnFilters = false;

    /**
     * @var bool
     */
    protected $showButtonsActions = true;

    /**
     * @var bool
     */
    protected $showDateFilters = true;



    /**
     * Definition of
     * @var string | boolean
     */
    protected $rowAction = false;


    /**
     * Show or hide exporter to CSV
     * @var boolean
     */
    protected $showExportToCSV = false;



    /**
     * Value to specify items per page (pagination)
     * @var array
     */
    protected $valuesOfItemPerPage = array(5, 10, 20, 50 , 100);


    /**
    * Get maximal rows to returning. Data tables can use
    * pagination, but also can get data by ajax, and use
    * java script to pagination (and variable destiny for this case)
    *
    * @var int
    */
    protected $dataTablesMaxRows = 999;


    /**
     * Template Map
     * @var array
     */
    protected $templateMap = array();


    /**
     * ModuleOptions constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        $this->templateMap = array(
                'paginator-slide' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/slide-paginator.phtml',__DIR__, LAYOUT),
                'default-params' =>sprintf(  '%s/../../../../Admin/view/layout/%s/templates/default-params.phtml',__DIR__, LAYOUT),
                'material' =>sprintf(  '%s/../../../../Admin/view/layout/%s/templates/material/container-b3.phtml',__DIR__, LAYOUT),
                'container' =>sprintf(  '%s/../../../../Admin/view/layout/%s/templates/container-b3.phtml',__DIR__, LAYOUT),
                'data-table-init' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/data-table-init.phtml',__DIR__, LAYOUT),
                'custom-b2' =>sprintf(  '%s/../../../../Admin/view/layout/%s/templates/custom-b2.phtml',__DIR__, LAYOUT),
                'custom-b3' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/custom-b3.phtml',__DIR__, LAYOUT),
                'search' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/search.phtml',__DIR__, LAYOUT),
                'option' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/option.phtml',__DIR__, LAYOUT),
                'select-status' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/select-status.phtml',__DIR__, LAYOUT),
                'item-per-page' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/item-per-page.phtml',__DIR__, LAYOUT),
                'data-table-filter' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/data-table-filter.phtml',__DIR__, LAYOUT),
                'date-time-piker' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/date-time-piker.phtml',__DIR__, LAYOUT),
                'actions-add' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-add.phtml',__DIR__, LAYOUT),
                'actions-active' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-active.phtml',__DIR__, LAYOUT),
                'actions-inactive' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-inactive.phtml',__DIR__, LAYOUT),
                'actions-trash' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-trash.phtml',__DIR__, LAYOUT),
                'actions-ajuda' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-ajuda.phtml',__DIR__, LAYOUT),
                'actions-csv' => sprintf(  '%s/../../../../Admin/view/layout/%s/templates/table/actions/actions-csv.phtml',__DIR__, LAYOUT),
        );

        parent::__construct($options);
    }

    /**
     * @return bool
     */
    public function getShowExportToCSV()
    {
        return $this->showExportToCSV;
    }

    /**
     * @param $showExportToCSV
     */
    public function setShowExportToCSV($showExportToCSV)
    {
        $this->showExportToCSV = $showExportToCSV;
    }

    /**
     * @return bool
     */
    public function isShowStatusFilters(): bool
    {
        return $this->showStatusFilters;
    }

    /**
     * @param bool $showStatusFilters
     * @return ModuleOptions
     */
    public function setShowStatusFilters(bool $showStatusFilters): ModuleOptions
    {
        $this->showStatusFilters = $showStatusFilters;
        return $this;
    }


    /**
     * @return bool
     */
    public function isShowDateFilters(): bool
    {
        return $this->showDateFilters;
    }

    /**
     * @param bool $showDateFilters
     * @return ModuleOptions
     */
    public function setShowDateFilters(bool $showDateFilters)
    {
        $this->showDateFilters = $showDateFilters;
        return $this;
    }

    /**
     * Set template map
     * @param array $templateMap
     */
    public function setTemplateMap($templateMap)
    {
        $this->templateMap =array_merge($this->templateMap, $templateMap);
    }


    /**
     * Set template map
     *
     * @return array
     */
    public function getTemplateMap()
    {
        return $this->templateMap;
    }

    /**
     * Get maximal rows to returning
     *
     * @return int
     */
    public function getDataTablesMaxRows()
    {
        return $this->dataTablesMaxRows;
    }

    /**
     * Set maximal rows to returning.
     *
     * @param int $dataTablesMaxRows
     * @return $this
     */
    public function setDataTablesMaxRows($dataTablesMaxRows)
    {
        $this->dataTablesMaxRows = $dataTablesMaxRows;
        return $this;
    }

    /**
     * Get Array of values to set items per page
     * @return array
     */
    public function getValuesOfItemPerPage()
    {
        return $this->valuesOfItemPerPage;
    }

    /**
     *
     * Set Array of values to set items per page
     *
     * @param array $valuesOfItemPerPage
     * @return $this
     */
    public function setValuesOfItemPerPage($valuesOfItemPerPage)
    {
        $this->valuesOfItemPerPage = $valuesOfItemPerPage;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getShowPagination()
    {
        return $this->showPagination;
    }

    /**
     * @return bool
     */
    public function getShowQuickSearch()
    {
        return $this->showQuickSearch;
    }

    /**
     * @return bool
     */
    public function getShowItemPerPage()
    {
        return $this->showItemPerPage;
    }

    /**
     * @return int
     */
    public function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    /**
     * @return bool
     */
    public function getShowColumnFilters()
    {
        return $this->showColumnFilters;
    }

    /**
     * @return bool
     */
    public function isShowButtonsActions(): bool
    {
        return $this->showButtonsActions;
    }

    /**
     * @return array
     */
    public function getValueButtonsActions(): array
    {
        return $this->valueButtonsActions;
    }


    /**
     * @return bool|string
     */
    public function getRowAction()
    {
        return $this->rowAction;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $showPagination
     * @return ModuleOptions
     */
    public function setShowPagination($showPagination)
    {
        $this->showPagination = $showPagination;
        return $this;
    }

    /**
     * @param $showQuickSearch
     * @return ModuleOptions
     */
    public function setShowQuickSearch($showQuickSearch)
    {
        $this->showQuickSearch = $showQuickSearch;
        return $this;
    }

    /**
     * @param $showItemPerPage
     * @return ModuleOptions
     */
    public function setShowItemPerPage($showItemPerPage)
    {
        $this->showItemPerPage = $showItemPerPage;
        return $this;
    }

    /**
     * @param $itemCountPerPage
     * @return ModuleOptions
     */
    public function setItemCountPerPage($itemCountPerPage)
    {
        $this->itemCountPerPage = $itemCountPerPage;
        return $this;
    }

    /**
     * @param $showColumnFilters
     * @return ModuleOptions
     */
    public function setShowColumnFilters($showColumnFilters)
    {
        $this->showColumnFilters = $showColumnFilters;
        return $this;
    }

    /**
     * @param bool $showButtonsActions
     * @return ModuleOptions
     */
    public function setShowButtonsActions(bool $showButtonsActions): ModuleOptions
    {
        $this->showButtonsActions = $showButtonsActions;
        return $this;
    }

    /**
     * @param array $valueButtonsActions
     * @return ModuleOptions
     */
    public function setValueButtonsActions(array $valueButtonsActions): ModuleOptions
    {
        $this->valueButtonsActions = $valueButtonsActions;
        return $this;
    }


    /**
     * @param $rowAction
     * @return ModuleOptions
     */
    public function setRowAction($rowAction)
    {
        $this->rowAction = $rowAction;
        return $this;
    }
}
