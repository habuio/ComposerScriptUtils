<?php

namespace Habu\ComposerScriptUtils\Configuration\Handler;

use Habu\ComposerScriptUtils\Configuration\AbstractConfigurationHandler;

/**
 * Required configuration handler.
 *
 * This handler will throw an exception if a key defined within your default configuration
 * definition is not found upon accessing the key in the actual configuration.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
class Required extends AbstractConfigurationHandler
{
    /**
     * Return the value or throw an exception if the value is empty.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function get($value)
    {
        if (empty($value) && $value !== '0') {
            throw new \InvalidArgumentException(sprintf("Configuration key %s is required.", $this->getKey()));
        }

        return $value;
    }
}
