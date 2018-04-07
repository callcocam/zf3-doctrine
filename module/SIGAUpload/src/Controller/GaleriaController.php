<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace SIGAUpload\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;

class GaleriaController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "siga-upload";
        $this->controller = "galeria";
        $this->template = sprintf("siga-upload/galeria/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'SIGAUpload\Service\UploadService';
        $this->form = 'SIGAUpload\Form\UploadForm';
        $this->filter = 'SIGAUpload\Filter\UploadFilter';
        $this->setServiceManager('SIGAUpload\Table\GaleriaTable', $this->factoryTable);
        $this->setEntity('SIGAUpload\Entity\UploadEntity')->setTable('SIGAUpload\Table\GaleriaTable');
    }

    public function listarAction()
    {
        if (is_string($this->form)):
            $this->getForm();
        endif;
        $this->templateCuston = 'custom';
        $this->templateList = sprintf('siga-upload/galeria/%s/upload-gallery-preview', LAYOUT);
        //I don't know if it necesary to validate that request is POST
        $queryBuilder = $this->repository->createQueryBuilder("p");

        $queryBuilder->where($queryBuilder->expr()->eq("p.assets", ":assets"));
        $queryBuilder->andWhere($queryBuilder->expr()->eq("p.parent", ":parent"));
        $queryBuilder->andWhere($queryBuilder->expr()->eq("p.tipo", ":tipo"));


        $queryBuilder->setParameter('assets', $this->params()->fromPost('assets', "gallery"));
        $queryBuilder->setParameter('parent', $this->params()->fromPost('parent', '0'));
        $queryBuilder->setParameter('tipo', "galeria");

        $this->table->setSource($queryBuilder)
            ->setRoute($this->getRoute($this->route))
            ->setController($this->controller)
            ->setParamAdapter($this->getRequest()->getPost());
        $view = $this->table->render($this->templateCuston, $this->templateList);
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('form', $this->form);
        $view->setVariable('controller', $this->controller);

        return $view;
    }

    public function previewAction()
    {
        if (!$this->identity()):
            return $this->auth();
        endif;
        $image = $this->params()->fromQuery();
        if (is_string($this->form)):
            $this->getForm();
        endif;
        $this->form->get('path')->setValue($this->getRequest()->getServer('DOCUMENT_ROOT'));
        $this->form->get('assets')->setValue($image['assets']);
        $this->form->get('parent')->setValue($image['parent']);
        $view = new ViewModel([
            'form' => $this->form,
            'route' => $this->getRoute($this->route),
            'controller' => $this->controller,
        ]);
        $view->setTemplate("siga-upload/galeria/preview");
        $view->setTerminal(true);
        return $view;

    }

    public function createAction()
    {
        if (!$this->identity()):
            return $this->auth();
        endif;
        $id = $this->params()->fromRoute("id", 0);
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if ($id) {
            $data = $this->repository->find($id);
            if (!$data) {
                return $this->redirect()->toRoute(sprintf("%s/default", $this->getRoute($this->route)),
                    [
                        'controller' => $this->controller,
                        'action' => "create"
                    ]);
            }

            $this->form->setData($this->extracted($data->toArray()));
        }

        $view = new ViewModel($this->args);
        $view->setTemplate($this->template);
        $view->setTerminal(true);
        $view->setVariable('id', $id);
        $view->setVariable('form', $this->form);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('controller', $this->controller);
        return $view;
    }

    public function removeAction()
    {
        if (!$this->identity()):
            return $this->auth();
        endif;
        $id = $this->params()->fromRoute("id", 0);
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if ($id) {
            $data = $this->repository->find($id);
            if ($data) {

                if (is_string($this->service)):
                    $this->getService();
                endif;
                $this->args = array_merge($this->args, $this->service->remove(["id" => $id]));
                if (file_exists(sprintf("%s%s", $this->getRequest()->getServer('DOCUMENT_ROOT'), $data->getCover()))) {
                    unlink(sprintf("%s%s", $this->getRequest()->getServer('DOCUMENT_ROOT'), $data->getCover()));
                }
            }

        }
        $this->templateCuston = 'custom';
        $this->templateList = sprintf('siga-upload/galeria/%s/upload-gallery-preview', LAYOUT);
        //I don't know if it necesary to validate that request is POST
        $queryBuilder = $this->repository->createQueryBuilder("p");
        $queryBuilder->where($queryBuilder->expr()->eq("p.assets", ":assets"));
        $queryBuilder->andWhere($queryBuilder->expr()->eq("p.parent", ":parent"));
        $queryBuilder->andWhere($queryBuilder->expr()->eq("p.tipo", ":tipo"));
        $queryBuilder->setParameter('assets', $this->params()->fromQuery('assets', "gallery"));
        $queryBuilder->setParameter('parent', $this->params()->fromQuery('parent', '0'));
        $queryBuilder->setParameter('tipo', "galeria");
        $this->table->setSource($queryBuilder)
            ->setRoute($this->getRoute($this->route))
            ->setController($this->controller)
            ->setParamAdapter($this->getRequest()->getPost());
        $view = $this->table->render($this->templateCuston, $this->templateList);
        $view->setTerminal(true);
        $view->setVariable('route', $this->getRoute($this->route));
        $view->setVariable('form', $this->form);
        $view->setVariable('controller', $this->controller);
        return $view;

    }
}