<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 25/03/2018
 * Time: 00:13
 */

namespace Core\Navigation;


use Core\Entity\AbstractRepository;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\Navigation\Service\DefaultNavigationFactory;

class Navigation extends DefaultNavigationFactory
{
    /**
     * @param ContainerInterface $serviceLocator
     *
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getPages(ContainerInterface $serviceLocator)
    {

        if (null === $this->pages) {
            /**
             * @var $fetchMenu EntityManager
             */
            $fetchMenu = $serviceLocator->get("Doctrine\ORM\EntityManager");
            $sql = $fetchMenu->getRepository("Admin\\Entity\\MenuEntity")->createQueryBuilder('genus');
            $sql->where($sql->expr()->isNull('genus.parent'));
            $Datas = $sql->getQuery()->getResult();
            if($Datas):
                foreach($Datas as $key=>$row)
                {
                    if(!empty($row->getRoute())):
                        $Pages=[];
                        $sql = $fetchMenu->getRepository("Admin\\Entity\\MenuEntity")->createQueryBuilder('genus');
                        $sql->where($sql->expr()->eq('genus.parent', $row->getId()));
                        $subMenu = $sql->getQuery()->getResult();

                        if($subMenu):
                            foreach($subMenu as $subrow)
                            {
                                if(!empty($subrow->getRoute())):
                                    $Pages[]= [
                                        'label' => $subrow->getName(),
                                        'route' => sprintf("adm-%s/default",$subrow->getRoute()->getRoute()),
                                        'controller' => $subrow->getController(),
                                        'privilege' => $subrow->getAction(),
                                        'action' => $subrow->getAction(),
                                        'resource' => $subrow->getAlias(),
                                        'role' => $subrow->getRole(),
                                        'icone' => $subrow->getIcone(),
                                        'pages'=>[
                                            [
                                                'label' => $subrow->getName(),
                                                'route' => sprintf("adm-%s/default",$subrow->getRoute()->getRoute()),
                                                'privilege' => 'create',
                                                'controller' => $subrow->getController(),
                                                'action' => 'create',
                                                'resource' => $subrow->getAlias(),
                                                'role' => $subrow->getRole()
                                            ], [
                                                'label' => $subrow->getName(),
                                                'route' => sprintf("adm-%s/default",$subrow->getRoute()->getRoute()),
                                                'privilege' => 'editar',
                                                'controller' => $subrow->getController(),
                                                'action' => 'editar',
                                                'resource' => $subrow->getAlias(),
                                                'role' => $subrow->getRole()
                                            ], [
                                                'label' => $subrow->getName(),
                                                'route' => sprintf("adm-%s/default",$subrow->getRoute()->getRoute()),
                                                'privilege' => 'ver',
                                                'controller' => $subrow->getController(),
                                                'action' => 'ver',
                                                'resource' => $subrow->getAlias(),
                                                'role' => $subrow->getRole()
                                            ],
                                        ]
                                    ];
                                endif;
                            }
                        endif;
                        $configuration['navigation'][$this->getName()][$row->getName()] = [
                            'label' => $row->getName(),
                            'route' =>sprintf("adm-%s/default",$row->getRoute()->getRoute()),
                            'controller' => $row->getController(),
                            'action' => $row->getAction(),
                            'privilege' => $row->getAction(),
                            'resource' => $row->getAlias(),
                            'role' => $row->getRole(),
                            'icone' => $row->getIcone(),
                            'pages'=>$Pages
                        ];
                    endif;
                }
            endif;
            if (!isset($configuration['navigation'])) {
                return $this->pages;
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new \InvalidArgumentException(sprintf(
                    'Failed to find a navigation container by the name "%s"',
                    $this->getName()
                ));
            }

            $application = $serviceLocator->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);

        }
        return $this->pages;
    }
}