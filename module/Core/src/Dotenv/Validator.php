<?php

namespace Core\Dotenv;

use Core\Dotenv\Exception\InvalidCallbackException;
use Core\Dotenv\Exception\ValidationException;

/**
 * This is the validator class.
 *
 * It's responsible for applying validations against a number of variables.
 */
class Validator
{
    /**
     * The variables to validate.
     *
     * @var array
     */
    protected $variables;

    /**
     * The loader instance.
     *
     * @var Loader
     */
    protected $loader;

    /**
     * Create a new validator instance.
     *
     * @param array $variables
     * @param Loader $loader
     *
     * @throws InvalidCallbackException
     * @throws ValidationException
     */
    public function __construct(array $variables, Loader $loader)
    {
        $this->variables = $variables;
        $this->loader = $loader;

        $this->assertCallback(
            function ($value) {
                return $value !== null;
            },
            'is missing'
        );
    }

    /**
     * Assert that each variable is not empty.
     *
     * @return Validator
     */
    public function notEmpty()
    {
        return $this->assertCallback(
            function ($value) {
                return strlen(trim($value)) > 0;
            },
            'is empty'
        );
    }

    /**
     * Assert that each specified variable is an integer.
     *
     * @return Validator
     * @throws InvalidCallbackException|ValidationException
     */
    public function isInteger()
    {
        return $this->assertCallback(
            function ($value) {
                return ctype_digit($value);
            },
            'is not an integer'
        );
    }

    /**
     * Assert that each specified variable is a boolean.
     *
     * @return Validator
     */
    public function isBoolean()
    {
        return $this->assertCallback(
            function ($value) {
                if ($value === '') {
                    return false;
                }

                return (filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== NULL);
            },
            'is not a boolean'
        );
    }

    /**
     * Assert that each variable is amongst the given choices.
     *
     * @param string[] $choices
     *
     * @return Validator
     */
    public function allowedValues(array $choices)
    {
        return $this->assertCallback(
            function ($value) use ($choices) {
                return in_array($value, $choices);
            },
            'is not an allowed value'
        );
    }

    /**
     * Assert that the callback returns true for each variable.
     *
     * @param callable $callback
     * @param string   $message
     *
     * @throws InvalidCallbackException|ValidationException
     *
     * @return Validator
     */
    protected function assertCallback($callback, $message = 'failed callback assertion')
    {
        if (!is_callable($callback)) {
            throw new InvalidCallbackException('The provided callback must be callable.');
        }

        $variablesFailingAssertion = array();
        foreach ($this->variables as $variableName) {
            $variableValue = $this->loader->getEnvironmentVariable($variableName);
            if (call_user_func($callback, $variableValue) === false) {
                $variablesFailingAssertion[] = $variableName." $message";
            }
        }

        if (count($variablesFailingAssertion) > 0) {
            throw new ValidationException(sprintf(
                'One or more environment variables failed assertions: %s.',
                implode(', ', $variablesFailingAssertion)
            ));
        }

        return $this;
    }
}
