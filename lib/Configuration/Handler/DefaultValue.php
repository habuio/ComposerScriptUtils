<?php

namespace Habu\ComposerScriptUtils\Configuration\Handler;

use Habu\ComposerScriptUtils\Configuration\AbstractConfigurationHandler;

/**
 * DefaultValue configuration handler.
 *
 * This handler lets you define a default value to be returned for a configuration
 * key defined within your default configuration definition, that's not present in
 * the actual configuration.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
class DefaultValue extends AbstractConfigurationHandler
{
    /**
     * @var mixed
     */
    private $defaultValue;

    /**
     * DefaultValue constructor.
     *
     * @param mixed $defaultValue
     */
    public function __construct($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * Return either the actual value (if it's not empty) or the
     * defined default value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function get($value)
    {
        return !empty($value) || $value === '0' ? $value : $this->defaultValue;
    }
}
