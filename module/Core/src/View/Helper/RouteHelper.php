<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 22:13
 */

namespace Core\View\Helper;


use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class RouteHelper extends AbstractHelper
{
    protected $rota_and_contrller_action;
    protected $route;
    protected $controller = "index";
    protected $action = "home";
    protected $id = 0;
    protected $parans = array();
    protected $queryParams;

    /**
     * @return mixed
     */
    public function getRotaAndContrllerAction( $index = "" )
    {
        if (empty($index)) {
            return $this->rota_and_contrller_action;
        }
        if (isset($this->rota_and_contrller_action[$index])) {
            return $this->rota_and_contrller_action[$index];
        }
        return "";
    }

    /**
     * @param mixed $rota_and_contrller_action
     * @return RouteHelper
     */
    public function setRotaAndContrllerAction( $rota_and_contrller_action )
    {
        $this->rota_and_contrller_action = $rota_and_contrller_action;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute( $route )
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController( $controller )
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction( $action )
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id )
    {
        $this->id = $id;
    }

    public function getParans()
    {
        return $this->parans;
    }

    public function setParans( $parans )
    {
        $this->parans = $parans;
    }

    public function getParan( $param, $default = null )
    {
        if (isset($this->parans[$param])):
            return $this->parans[$param];
        endif;
        return $default;
    }

    /**
     * RouteHelper constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->queryParams = $container->get('request')->getQuery();
        $param = $container->get('application')->getMvcEvent()->getRouteMatch();
        if (!is_null($param)):
            $this->setParans($param->getParams());
            $controller = $param->getParams();
            $result = [
                'route' => $param->getMatchedRouteName(),
                'controller' => isset($controller['__CONTROLLER__']) ? $controller['__CONTROLLER__'] : "",
                'controller' => isset($controller['__CONTROLLER__']) ? $controller['__CONTROLLER__'] : "",
                'action' => isset($controller['action']) ? $controller['action'] : null,
            ];

            if (isset($controller['type'])) {
                $result['type'] = $controller['type'];
            }
            if (isset($controller['slug'])) {
                $result['slug'] = $controller['slug'];
            }
            $this->setRotaAndContrllerAction($result);
            if (isset($controller['__CONTROLLER__'])) {
                $this->setController($controller['__CONTROLLER__']);
            }

            $this->setRoute($param->getMatchedRouteName());

            if (isset($controller['action'])) {
                $this->setAction($this->getRotaAndContrllerAction('action'));
            }

            if (isset($controller['id'])) {
                $this->rota_and_contrller_action['id'] = $controller['id'];
                $this->setId($this->getRotaAndContrllerAction('id'));
            }
            if (isset($controller['page'])) {
                $this->rota_and_contrller_action['page'] = $controller['page'];

            }
        endif;

    }

    /**
     * @return mixed
     */
    public function getQueryParams( $name = "" )
    {
        if ($name):
            return $this->queryParams[$name];
        endif;
        return $this->queryParams;
    }

    /**
     * @return mixed
     */
    public function getQueryParam( $name, $default = null )
    {
        if ($name):
            return $this->queryParams[$name];
        endif;
        return $default;
    }
}