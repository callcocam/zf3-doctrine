<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 11:39
 */

namespace Core\Mail\Factory;


use Interop\Container\ContainerInterface;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class SmtpTransport implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     *
     * @return object
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        if (isset($config['Mail']['transport']['smtpOptions'])) {
            $valuesOptions = $config['Mail']['transport']['smtpOptions'];
            $transportSslOptions = $config['Mail']['transport']['transportSsl'];

            if ($transportSslOptions['use_ssl'])
                $valuesOptions['connection_config']['ssl'] = $transportSslOptions['connection_type'];

            $smtpOptions = new SmtpOptions($valuesOptions);
            $transport = new Smtp($smtpOptions);

        } else {
            throw new \Exception('Você precisa configurar o STMP Options no module.config.php');
        }

        return $transport;
    }

}