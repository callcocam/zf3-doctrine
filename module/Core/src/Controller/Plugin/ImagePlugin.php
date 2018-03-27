<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 23/03/2018
 * Time: 19:35
 */

namespace Core\Controller\Plugin;


use Core\Controller\AbstractController;
use Core\Image\ImageManager;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ImagePlugin extends AbstractPlugin
{

    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function get(AbstractController $abstractController)
    {
//      Get the file name from GET variable.
        $fileName = $abstractController->params()->fromQuery('name', '/dist/uploads/images/no_image.jpg');
        // Check whether the user needs a thumbnail or a full-size image.
        $isThumbnail = (bool)$abstractController->params()->fromQuery('thumbnail', false);

        $this->imageManager->setSaveToDir($abstractController->getRequest()->getServer('DOCUMENT_ROOT'));
        // Get path to image file.
        $fileName = $this->imageManager->getImagePathByName($fileName);
        if ($isThumbnail) {
            $desiredWidth = $abstractController->params()->fromQuery('w', 540);
            // Resize the image.
            $fileName = $this->imageManager->resizeImage($fileName, $desiredWidth);
        }

        // Get image file info (size and MIME type).
        $fileInfo = $this->imageManager->getImageFileInfo($fileName);
        if ($fileInfo === false) {
            // Set 404 Not Found status code
            $fileInfo = $this->imageManager->getImageFileInfo('/dist/uploads/images/no_image.jpg');
        }

        // Write HTTP headers.
        $response = $abstractController->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine("Content-type: " . $fileInfo['type']);
        $headers->addHeaderLine("Content-length: " . $fileInfo['size']);

        // Write file content.
        $fileContent = $this->imageManager->getImageFileContent($fileName);
        if ($fileContent !== false) {
            $response->setContent($fileContent);
        } else {
            // Set 500 Server Error status code.
            $abstractController->getResponse()->setStatusCode(500);
            return;
        }

        if ($isThumbnail) {
            // Remove temporary thumbnail image file.
            unlink($fileName);
        }

        // Return Response to avoid default view rendering.
        return $abstractController->getResponse();
    }
}