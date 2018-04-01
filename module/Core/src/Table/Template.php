<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 28/03/2018
 * Time: 00:06
 */

namespace Core\Table;


use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

class Template
{
    protected $folderTemplate = 'templates';
    protected $view;

    public function __construct(ContainerInterface $serviceLocator)
    {
        $this->view = $serviceLocator->get('View');
    }

    public function render($mailTemplate, array $data)
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate("{$this->getFolderTemplate()}/{$mailTemplate}.phtml");
        $viewModel->setOption('has_parent', true);
        $viewModel->setVariables($data);

        return $this->view->render($viewModel);
    }

    public function getFolderTemplate()
    {
        return sprintf("layout/%s/%s",LAYOUT, $this->folderTemplate);
    }

    public function setFolderTemplate($folderTemplate)
    {
        $this->folderTemplate = $folderTemplate;
    }
}