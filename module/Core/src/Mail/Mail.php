<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 11:31
 */

namespace Core\Mail;


use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\Mail\Transport\Smtp;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Message;

class Mail implements MailInterface
{
    /**
     * @var Smtp
     */
    protected $transport;
    protected $options;
    protected $template;

    protected $subject;
    protected $to;
    protected $data;
    protected $viewTemplate;
    protected $from;

    public function __construct(ContainerInterface $serviceLocator)
    {
        $this->transport = $serviceLocator->get('mail-transport');
        $this->options = $serviceLocator->get('mail-options');
        $this->template = $serviceLocator->get('mail-template');

    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param mixed $from
     * @return Mail
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransport()
    {
        return $this->transport->getOptions()->toArray();
    }


    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;

        return $this;
    }

    public function execute()
    {
        $html = new MimePart($this->template->render($this->viewTemplate, $this->data));
        $html->type = $this->options->getType();
        $html->encoding = $this->options->getHtmlEncoding();

        $body = new MimeMessage();
        $body->setParts(array($html));
        $message = new Message();
        $message->addFrom($this->from)
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($body)
            ->setEncoding($this->options->getMessageEncoding());

        if (count($this->options->getBcc())) {
            $message->addBcc($this->options->getBcc());
        }

        return $message;
    }

    public function send()
    {
        return $this->transport->send($this->execute());
    }

}