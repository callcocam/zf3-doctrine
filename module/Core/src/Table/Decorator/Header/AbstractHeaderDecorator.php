<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Header;

use Core\Table\Decorator\AbstractDecorator;

abstract class AbstractHeaderDecorator extends AbstractDecorator
{

    /**
     * Header object
     * @var \Core\Table\Header
     */
    protected $header;

    /**
     *
     * @return \Core\Table\Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     *
     * @param \Core\Table\Header $header
     * @return \Core\Table\Decorator\Header\AbstractHeaderDecorator
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
}
