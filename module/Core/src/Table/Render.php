<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table;

use Zend\Debug\Debug;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\View\Resolver;
use Zend\View\Renderer\PhpRenderer;
use Core\Table\Options\ModuleOptions;

class Render extends AbstractCommon
{

    /**
     * PhpRenderer object
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     *
     * @var ModuleOptions
     */
    protected $options;

    /**
     *
     * @param AbstractTable $table
     */
    public function __construct($table)
    {
        $this->setTable($table);
    }

    /**
     * Rendering paginator
     *
     * @return string
     */
    public function renderPaginator()
    {
        $paginator = $this->getTable()->getSource()->getPaginator();
        $paginator->setView($this->getRenderer());
        $res = $this->getRenderer()->paginationControl($paginator, 'Sliding', 'paginator-slide');
        return $res;
    }

     /**
     * Rendering json for dataTable
      *
     * @return string
     */
    public function renderDataTableJson()
    {
        $res = array();
        $render = $this->getTable()->getRow()->renderRows('array_assc');
        $res['sEcho'] = $render;
        $res['iTotalDisplayRecords'] = $this->getTable()->getSource()->getPaginator()->getTotalItemCount();
        $res['aaData'] = $render;
        $res['draw'] = $render;
        $res['data'] = $render;
        return $res;
    }


    public function renderNewDataTableJson()
    {

        $render = $this->getTable()->getRow()->renderRows('array');

        $res = array(
            'draw' => $render,
            'recordsFiltered' => $this->getTable()->getSource()->getPaginator()->getTotalItemCount(),
            'data' => $render,
        );

        return json_encode($res);
    }

    /**
     * Rendering init view for dataTable
     *
     * @return string
     */
    public function renderDataTableAjaxInit()
    {
        $renderedHeads = $this->renderHead();

        $view = new ViewModel();
        $view->setTemplate('data-table-init');
        $view->setVariable('headers', $renderedHeads);
        $view->setVariable('attributes', $this->getTable()->getAttributes());

        return $view->render($view);

    }


    public function renderCustom($template)
    {

        $tableConfig = $this->getTable()->getOptions();
        $rowsArray = $this->getTable()->getRow()->renderRows('array_assc');

        $view = new ViewModel();
        $view->setTemplate($template);
        $view->setVariable('rows', $rowsArray);
        $view->setVariable('paginator', $this->renderPaginator());
        $view->setVariable('paramsWrap', $this->renderParamsWrap());
        $view->setVariable('itemCountPerPage', $this->getTable()->getParamAdapter()->getItemCountPerPage());
        $view->setVariable('quickSearch', $this->getTable()->getParamAdapter()->getQuickSearch());
        $view->setVariable('name', $tableConfig->getName());
        $view->setVariable('itemCountPerPageValues', $tableConfig->getValuesOfItemPerPage());
        $view->setVariable('showQuickSearch', $tableConfig->getShowQuickSearch());
        $view->setVariable('showPagination', $tableConfig->getShowPagination());
        $view->setVariable('showItemPerPage', $tableConfig->getShowItemPerPage());
        $view->setVariable('showExportToCSV', $tableConfig->getShowExportToCSV());

        return $view;
    }

    /**
     * Rendering table
     *
     * @return string
     * @throws \Exception
     */
    public function renderTableAsHtml()
    {
        $render = '';
        $tableConfig = $this->getTable()->getOptions();
        /**
         * carregas os bostões se estiver ativado para modulo
         */
        if($tableConfig->isShowButtonsActions()){
            $render .= $this->renderAction();
        }
        $view = new ViewModel();
        $render .= $this->renderHead();
        $render = sprintf('<thead>%s</thead>', $render);
        $render .= $this->getTable()->getRow()->renderRows();
        $table = sprintf('<table %s>%s</table>', $this->getTable()->getAttributes(), $render);


        $view->setTemplate(sprintf('layout/%s/templates/container-b3', LAYOUT));
        $view->setVariable('table', $table);

        $view->setVariable('router', $this->getTable()->getRoute());
        $view->setVariable('controller', $this->getTable()->getController());

        $view->setVariable('paramsWrap', $this->renderParamsWrap());

        $view->setVariable('name', $tableConfig->getName());

        /**
         * Inicia o filtro de items por paginas
         */
        $view->setVariable('quickSearch', '');
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->getShowQuickSearch()){
            $view->setVariable('quickSearch', $this->getTable()->getParamAdapter()->getQuickSearch());
        }

        /**
         * Inicia o filtro de items por paginas
         */
        $view->setVariable('itemCountPerPageValues', '');
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->getShowItemPerPage()){
            $view->setVariable('ValuesOfItemPerPage', $this->renderValuesOfItemPerPage());
        }


        /**
         * Inicia o filtro de status do registro
         */
        $view->setVariable('valueStatus', "");
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->isShowStatusFilters()) {
            $view->setVariable('valueStatus', $this->renderStatus());
        }

        /**
         * Inicia o filtro de QuickSearch
         */
        $view->setVariable('QuickSearch', "");
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->getShowQuickSearch()) {
            $view->setVariable('QuickSearch', $this->renderQuickSearch());
        }
        /**
         * Inicia o filtro de para datas
         */
        $view->setVariable('DateFilters', "");
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->isShowDateFilters()) {
            $view->setVariable('DateFilters', $this->renderDateFilters());
        }

        /**
         * Inicia paginator
         */
        $view->setVariable('paginator', "");
        /**
         * Verifica se ele esta habilitado para o modulo
         */
        if($tableConfig->getShowPagination()) {
            $view->setVariable('paginator', $this->renderPaginator());
        }


        $view->setVariable('showExportToCSV', $tableConfig->getShowExportToCSV());
        $view->setVariable('pages', get_object_vars($this->getTable()->getSource()->getPaginator()->getPages()));
        $view->setTerminal(true);
        return $view;
    }




    /**
     * Rendering head
     *
     * @return string
     */
    public function renderHead()
    {
        $headers = $this->getTable()->getHeaders();
        $render = '';
        foreach ($headers as $name => $title) {
            $render .= $this->getTable()->getHeader($name)->render();
        }
        $render = sprintf('<tr class="zf-title">%s</tr>', $render);
        return $render;
    }

    /**
     * Rendering head
     *
     * @return string
     */
    public function renderAction()
    {
        $collspam = count($this->getTable()->getHeaders());
        $actions = $this->getTable()->getActions();
        $render = '';
        foreach ($actions as $name => $title) {
            $render .= $this->getTable()->getActions($name)->render();
        }
        //tr-table-actions
        $view = new Template($this->getTable()->container);
        $render = $view->render("/table/tr-table-actions",[
            'render'=> $render,
            'collspam'=>$collspam
        ]);
         return $render;
    }

    /**
     * Rendering head
     *
     * @return string
     */
    public function renderDateFilters()
    {
        $render = $this->getTable()->getDateFilters("DateTimePiker")->render();
        return $render;
    }
    /**
     * Rendering head
     *
     * @return string
     */
    public function renderQuickSearch()
    {
        return  $this->getTable()->getQuickSearch("Search")->render();
    }

    /**
     * Rendering head
     *
     * @return string
     */
    public function renderStatus()
    {
        $status = $this->getTable()->getStatus();
        $render = '';
        foreach ($status as $name => $title) {
           $render .= $this->getTable()->getStatu($title)->render();
        }
        return $this->getRenderer()->render("select-status",[
            "class" => $this->getTable()->getStatu($title)->getClass(),
            "render"=>$render
        ]);
    }

    public function renderValuesOfItemPerPage()
    {
        $valuesOfItemPerPage = $this->getTable()->getValuesOfItemPerPages();
        $render = '';
        foreach ($valuesOfItemPerPage as $name => $title) {
           $render .= $this->getTable()->getValuesOfItemPerPage($name)->render();
        }
        return $this->getRenderer()->render('item-per-page',[
            "class" => $this->getTable()->getValuesOfItemPerPage($title)->getClass(),
            "render"=>$render,
            "id"=>"itemPerPage"
        ]);
    }
    /**
     * Rendering params wrap to ajax communication
     *
     * @return string
     * @throws \Exception
     */
    public function renderParamsWrap()
    {
        $view = new ViewModel();

        $view->setTemplate('default-params');
        $view->setVariable('zfTableColumn', $this->getTable()->getParamAdapter()->getColumn());
        $view->setVariable('zfTableItemPerPage', $this->getTable()->getParamAdapter()->getItemCountPerPage());
        $view->setVariable('zfTableOrder', $this->getTable()->getParamAdapter()->getOrder());
        $view->setVariable('zfTablePage', $this->getTable()->getParamAdapter()->getPage());
        $view->setVariable('zfTableQuickSearch', $this->getTable()->getParamAdapter()->getQuickSearch());
        $view->setVariable('rowAction', $this->getTable()->getOptions()->getRowAction());
        $view->setVariable('zfTableStatus', $this->getTable()->getParamAdapter()->getStatus());
        $view->setVariable('zfTableStartDate', $this->getTable()->getParamAdapter()->getStartDate());
        $view->setVariable('zfTableEndDate', $this->getTable()->getParamAdapter()->getEndDate());

        return $this->getRenderer()->render($view);
    }

    /**
     * Init renderer object
     */
    protected function initRenderer()
    {
        $renderer = new PhpRenderer();

        $plugins = $renderer->getHelperPluginManager();
        $config  = new \Zend\Form\View\HelperConfig;
        $config->configureServiceManager($plugins);

        $resolver = new Resolver\AggregateResolver();
        $map = new Resolver\TemplateMapResolver($this->getTable()->getOptions()->getTemplateMap());
        $resolver->attach($map);

        $renderer->setResolver($resolver);
        $this->renderer = $renderer;
    }

    /**
     * Get PHPRenderer
     * @return PhpRenderer
     */
    public function getRenderer()
    {
        if (!$this->renderer) {
            $this->initRenderer();
        }
        return $this->renderer;
    }

    /**
     * Set PhpRenderer
     * @param \Zend\View\Renderer\PhpRenderer $renderer
     */
    public function setRenderer(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }
}
