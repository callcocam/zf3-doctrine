<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Row;

class VarAttr extends AbstractRowDecorator
{

    /**
     * Class
     * @var string
     */
    protected $name;

    protected $value;

    protected $vars;

    public function __construct($options)
    {
        $this->name = $options['name'];
        $this->value = $options['value'];
        $this->vars = $options['vars'];
    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $values = array();

        foreach ($this->vars as $var) {
            $actualRow = $this->getRow()->getActualRow();
            $values[] = $actualRow[$var];
        }
        $value = vsprintf($this->value, $values);

        $this->getRow()->addVarAttr($this->name, $value);
        return $context;
    }
}
