<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Cell;

use Core\Entity\AbstractEntity;
use Core\Table\Table\Exception\InvalidArgumentException;

class Link extends AbstractCellDecorator
{

    /**
     * Array of variable attribute for link
     * @var array
     */
    protected $vars;

    /**
     * Link url
     * @var string
     */
    protected $url;


    /**
     * Constructor
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['url'])) {
            throw new InvalidArgumentException('Url key in options argument required');
        }

        $this->url = $options['url'];

        if (isset($options['vars'])) {
            $this->vars = is_array($options['vars']) ? $options['vars'] : array($options['vars']);
        }
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $values = array();
        if($context instanceof \DateTime){
            $context = $context->format("d/m/Y");
        }
        if (count($this->vars)) {
            if($this->getCell()->getActualRow() instanceof AbstractEntity){
                $actualRow = $this->getCell()->getActualRow()->toArray();
            }
            foreach ($this->vars as $var) {
                if($actualRow[$var] instanceof \DateTime):
                    $values[] = $actualRow[$var]->format("d/m/Y");
                else:
                    $values[] = $actualRow[$var];
                endif;
            }
        }
        $url = vsprintf($this->url, $values);
        return sprintf('<a  href="%s">%s</a>', str_replace(" ","",$url), $context);
    }
}
