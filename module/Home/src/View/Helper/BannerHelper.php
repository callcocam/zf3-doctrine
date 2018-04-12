<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 06/04/2018
 * Time: 22:39
 */

namespace Home\View\Helper;


use Banner\Entity\BannerEntity;
use Interop\Container\ContainerInterface;

class BannerHelper extends AbstractViewHelper
{

    /**
     * AbstractViewHelper constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->container = $container;
        $this->setTable(BannerEntity::class);
        $this->getEm();
    }

    public function getBanners($itemPage = 6) {
        $this->itemCountPerPage = $itemPage;
        $this->Select = $this->em->getRepository($this->table)->createQueryBuilder($this->getTableAlias());
        $this->Data = $this->getPaginator();
        return $this;
    }

    public function getBanner($criteria) {
        $this->Select = $this->em->getRepository($this->table)->findOneBy($criteria);
        $this->Data[] = $this->extracted($this->Select->toArray());
        return $this;
    }

    //Exibe o template view com echo!
    public function render($View) {
        $dataT= [];
        if ($this->Data):
            $active = "active";
            foreach ($this->Data as $data):
                $data = $data->toArray();
                $dataT['name'] =  $data['name'];
                $dataT['preview'] =  $data['preview'];
                $dataT['url'] =  $data['alias'];
                $dataT['cover'] = $this->view->basePath($data['cover']);
                $dataT['active'] = $active;
                $this->setKeys($dataT);
                $this->setValues($dataT);
                echo str_replace($this->Keys, $this->Values, $this->view->render($View, $dataT));
                $active = "";
            endforeach;
        endif;
    }
}