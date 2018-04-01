<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator;

class DecoratorPluginManager
{

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(

        'cellattr' => '\Core\Table\Decorator\Cell\AttrDecorator',
        'cellvarattr' => '\Core\Table\Decorator\Cell\VarAttrDecorator',
        'cellclass' => '\Core\Table\Decorator\Cell\ClassDecorator',
        'cellicon' => '\Core\Table\Decorator\Cell\Icon',
        'cellmapper' => '\Core\Table\Decorator\Cell\Mapper',
        'celllink' => '\Core\Table\Decorator\Cell\Link',
        'celltemplate' => '\Core\Table\Decorator\Cell\Template',
        'celleditable' => '\Core\Table\Decorator\Cell\Editable',
        'cellcallable' => '\Core\Table\Decorator\Cell\CallableDecorator',
        'cellstate' => '\Core\Table\Decorator\Cell\State',
        'cellcheck' => '\Core\Table\Decorator\Cell\Check',
        'cellbtn' => '\Core\Table\Decorator\Cell\Btn',
        'cellimg' => '\Core\Table\Decorator\Cell\Img',


        'rowclass' => '\Core\Table\Decorator\Row\ClassDecorator',
        'rowvarattr' => '\Core\Table\Decorator\Row\VarAttr',
        'rowseparatable' => '\Core\Table\Table\Decorator\Row\Separatable',
        'headercheck' => '\Core\Table\Decorator\Header\Check',
    );

    /**
     * Don't share header by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * @param mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof AbstractDecorator) {
            return;
        }
        throw new \DomainException('Invalid Decorator Implementation');
    }
    public function get($name, $options)
    {
        return (new \ReflectionClass($this->invokableClasses[$name]))->newInstance($options);
    }
}
