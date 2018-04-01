<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table;

use Core\Service\Date;
use Core\View\Helper\RouteHelper;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Service\ViewHelperManagerFactory;
use Zend\View\Helper\Url;

abstract class AbstractCommon
{

    /**
     * Table object
     * @var AbstractTable
     */
    protected $table;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var object
     */
    protected $user;

    /**
     * @var $acl AclHelper
     */
    protected $acl;

    /**
     * @var $Route string
     */
    protected $Route = "adm-admin";

    /**
     * @var $Controller string
     */
    protected $Controller = "admin";

    /**
     * @var $RouteHelper RouteHelper
     */
    protected $RouteHelper;

    /**
     * @var $ViewHelperManager ViewHelperManagerFactory
     */
    protected $ViewHelperManager;

    /**
     * helper para geração de rotas
     * @var $url Url
     */
    protected $url;

    /**
     * A pasta public do sistema
     * @var $basePath
     */
    protected $basePath;


    /**
     *
     * @return AbstractTable
     */
    public function getTable()
    {
        return $this->table;
    }


    /**
     *
     * @param AbstractTable $table
     * @return \Core\Table\AbstractCommon
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }


    /**
     * @return string
     */
    public function getRoute() {
        return $this->Route;
    }

    /**
     * @param string $Route
     *
     * @return string
     */
    public function setRoute(string $Route) {
        $this->Route = $Route;
        return $this;
    }

    public function getController() {
        return $this->Controller;
    }

    public function setController($Controller) {
        $this->Controller = $Controller;
        return $this;
    }


    public function getRouteHelper() {
        return $this->RouteHelper;
    }

    public function setRouteHelper(RouteHelper  $RouteHelper) {
        $this->RouteHelper = $RouteHelper;
        return $this;
    }

    /**
     * @return object
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param $user
     *
     * @return AbstractCommon
     */
    public function setUser($user): AbstractCommon {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getViewHelperManager() {
        return $this->ViewHelperManager;
    }

    /**
     * @return mixed
     */
    public function getUrl($Route, $params = [], $query = []) {
        $Url = $this->url;
        return $Url($Route, $params, $query);
    }

    /**
     * @return mixed
     */
    public function getBasePath($Path = "") {
        $basePath = $this->basePath;
        return $basePath($Path);
    }

    public function getConfig($key){
        $config = $this->container->get('config');
        if(isset($config[$key])):
            return $config[$key];
        endif;
        return $key;
    }

    public function getCreated(\DateTime $dateTime)
    {
        return new Date();
    }
}
