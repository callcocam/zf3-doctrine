<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Decorator\Condition;

use Zend\ServiceManager\AbstractPluginManager;

class ConditionPluginManager extends AbstractPluginManager
{

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'equal' => '\Core\Table\Decorator\Condition\Plugin\Equal',
        'notequal' => '\Core\Table\Decorator\Condition\Plugin\NotEqual',
        'between' => '\Core\Table\Decorator\Condition\Plugin\Between',
        'greaterthan' => '\Core\Table\Decorator\Condition\Plugin\GreaterThan',
        'lesserthan' => '\Core\Table\Decorator\Condition\Plugin\LesserThan',


    );

    /**
     * Don't share plugin by default
     *
     * @var bool
     */
    protected $shareByDefault = false;


    /**
     * See AbstractPluginManager
     *
     * @throws \DomainException
     * @param mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof AbstractCondition) {
            return;
        }
        throw new \DomainException('Invalid Condition Implementation');
    }
}
