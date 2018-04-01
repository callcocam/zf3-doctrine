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

    private $action;


    /**
     * Constructor
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct( array $options = array() )
    {
        if (!isset($options['vars'])) {
            throw new InvalidArgumentException('vars key in options argument required');
        }

            $this->vars = isset($options['vars']) ? $options['vars'] : "";
            $this->action = isset($options['action']) ? $options['action'] : "create";

    }

    /**
     * Rendering decorator
     * @param string $context
     * @param null $opt
     * @return string
     */
    public function render( $context, $opt = null )
    {
        if ($opt) {
            $this->view = new \Core\Table\Template($opt);
        }
        if ($context instanceof \DateTime) {
            $context = $context->format("d/m/Y");
        }

        if ($this->getCell()->getActualRow() instanceof AbstractEntity) {
            $actualRow = $this->getCell()->getActualRow()->toArray();
        } else {
            $actualRow = $this->getCell()->getActualRow();
        }

        if ($actualRow[$this->vars] instanceof \DateTime):
            $actualRow[$this->vars] = $actualRow[$this->vars]->format("d/m/Y");
        endif;

        //$url = vsprintf($this->url, $values);
        return $this->view->render("table/rows/link", [
            'id' => trim($actualRow[$this->vars]),
            'action' => $this->action,
            'context' => $context,
            'attr' => '',

        ]);
        //return sprintf('<a  href="%s">%s</a>', str_replace(" ","",$url), $context);
    }
}
