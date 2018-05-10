<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 02/05/2018
 * Time: 21:57
 */

namespace Home\View\Helper;


use Home\Adapter\Authentication;
use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class IdentityHelper extends AbstractHelper
{
    /**
     * @var ContainerInterface
     */
    private $container;
    private $storage;

    /**
     * IdentityPlugin constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
        $this->storage = $this->getStorage();
    }

    public function __invoke()
    {
        return $this->storage;
    }

    private function getStorage(){
        $auth = $this->container->get(Authentication::class);
        return $auth->getStorage()->read();
    }
}