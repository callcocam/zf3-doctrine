<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 24/03/2018
 * Time: 23:47
 */

namespace Core\Listener;


use Zend\Debug\Debug;
use Zend\EventManager\Event;
use Zend\View\Model\ViewModel;

class LayoutErrorListener extends Event
{
    public function __construct($e)
    {
        $error = $e->getError();
        if (!$error) {
            return;
        }

       // file_put_contents("./data/log.log",implode("",$error->getError()));
        $response = $e->getResponse();
        $exception = $e->getParam('exception');
        $exceptionJson = [];
        if ($exception) {
            $exceptionJson = [
                'class' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'stacktrace' => $exception->getTraceAsString(),
            ];
        }

        $errorJson = [
            'message' => 'An error occurred during execution; please try again later.',
            'error' => $error,
            'exception' => $exceptionJson,
        ];
        if ($error == 'error-router-no-match') {
            $errorJson['message'] = 'Resource not found.';
        }

        $sm = $e->getApplication()->getServiceManager();
        $serviceLog = $sm->get('errorhandling');
        if($exception){
           $serviceLog->logException($exception);
        }
        //var_dump($exception);

        $model = new ViewModel(['errors' => [$errorJson],'debug'=>true]);
        $model->setTerminal(true);
        $model->setTemplate(sprintf("admin/%s/error",LAYOUT));
        $e->setResult($model);

        return $model;
    }
}