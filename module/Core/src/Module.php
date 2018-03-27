<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Core;

use Admin\Entity\PrivilegeEntity;
use Admin\Entity\RoleEntity;
use Core\Controller\Plugin\Factory\UploadPluginFactory;
use Core\Controller\Plugin\ImagePlugin;
use Core\Dotenv\Dotenv;
use Core\HtmlElement\View\Helper;
use Core\Image\ImageManager;
use Core\Image\ImagesUpload;
use Core\Listener\LayoutErrorListener;
use Core\Listener\LayoutListener;
use Core\Navigation\Factory\NavigationFactory;
use Core\Permissions\Acl;
use Core\Service\Messages;
use Core\View\Helper\AclHelper;
use Core\View\Helper\DateHelper;
use Core\View\Helper\FlashMsg;
use Core\View\Helper\RouteHelper;
use Interop\Container\ContainerInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements BootstrapListenerInterface, ViewHelperProviderInterface, ServiceProviderInterface, ControllerPluginProviderInterface
{
    const VERSION = '3.0.3-dev';
    const SIS = 'SIGA Doctrine';


    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     *
     * @return void
     */
    public function onBootstrap(EventInterface $e) {

        $eventManager = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //$serviceManager->get(\Pdv\Services\Caixa::class)->getSelect();

        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError'], 2);
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, [$this, 'onRenderError'], 1);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 0);
        $eventManager->getSharedManager()
            ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) {
                (new LayoutListener($e));
            }, 100);
    }
    /**
     * @param $e
     * @return mixed
     */
    public function onDispatchError(MvcEvent $e) {
        return new LayoutErrorListener($e);
    }

    /**
     * @param $e
     * @return mixed
     */
    public function onRenderError(MvcEvent $e) {
        return new LayoutErrorListener($e);
    }
    /**
     * @param MvcEvent $e
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function onDispatch(MvcEvent $e) {
        $app = $e->getApplication()->getServiceManager();
        $dotenv = new Dotenv(dirname(__DIR__, 3));
        $dotenv->load();

        /**
         * @var $Authenticate Authentication
         */
//        $Authenticate = $app->get(Authentication::class);
//
//        if ($Authenticate->hasIdentity()):
//            $Identity = $Authenticate->getIdentity();
//            /**
//             * @var $Logado Logado
//             */
//            $Logado = $app->get(Logado::class);
//            $UserLogagado = $Logado->user($Identity->id);
//            /**
//             * @var $Company Company
//             */
//            $Company = $app->get(Company::class);
//            $Company->matriz($Identity->empresa);
//            $UserLogagado->restrito = $Company->getRestrito();
//            $UserLogagado->datEmpresa = $Company->getEmpResult();
//            $UserLogagado->datFiliais = $Company->getData();
//            $Authenticate->getStorage()->write($UserLogagado);
//        endif;
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories'=>[
                'Navigation' => NavigationFactory::class,
                Messages::class=>InvokableFactory::class,
                ImageManager::class => InvokableFactory::class,
                ImagesUpload::class => function(ContainerInterface $container){
                    return new ImagesUpload($container);
                },
            ]
        ];

    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
        'factories'=>[
            "FlashMsg" => function (ContainerInterface $container) {
                $ViewHelperManager = $container->get('ViewHelperManager');
                $viewHelper = new FlashMsg(
                    $ViewHelperManager->get('FlashMessenger'), $ViewHelperManager->get('inlinescript'), $ViewHelperManager->get('HeadLink'), $ViewHelperManager->get('url'));
                return $viewHelper;
            },
            "Route" => function (ContainerInterface $container) {
                $Route = new RouteHelper($container);
                return $Route;
            },
            "Tiny" => function (ContainerInterface $container) {
                $ViewHelperManager = $container->get('ViewHelperManager');
                $TinyElement = new Helper\Service\TinyElement(
                    $ViewHelperManager->get('inlinescript'), $ViewHelperManager->get('HeadLink'));
                return $TinyElement;
            },
            'Acl' => function(ContainerInterface $container) {
                $Em = $container->get("Doctrine\ORM\EntityManager");
                $Role = $Em->getRepository(RoleEntity::class);
                $Privileges = $Em->getRepository(PrivilegeEntity::class);
                $Acl = new Acl($container, $Role, $Privileges);
                // Return the new navigation helper instance
                return new AclHelper($Acl);
            }
        ],
            'invokables' => [
                //'phpthumb' => PHPThumb::class,
                //'Date' => DateHelper::class,
               // 'chartjs' => ChartJs::class,
                'html' => Helper\HtmlElement::class,
                'date'=>DateHelper::class,
                'Tab' => Helper\Service\TabElement::class,
                'Addon' => Helper\Service\AddonElement::class,
                'Actions' => Helper\Service\ActionsElement::class,
                'El' => Helper\Service\InputElement::class,
            ],
    ];

    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return [
            'factories'=>[
             'ImagePlugin' => function(ContainerInterface $container){
                return new ImagePlugin($container->get(ImageManager::class));
             },
                'UploadPlugin'=>UploadPluginFactory::class
            ]
        ];
    }
}
