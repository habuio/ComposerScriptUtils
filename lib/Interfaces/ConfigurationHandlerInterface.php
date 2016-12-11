<?php

namespace Habu\ComposerScriptUtils\Interfaces;

/**
 * Interface ConfigurationHandlerInterface.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
interface ConfigurationHandlerInterface
{
    /**
     * Internally set the key for this handler instance.
     *
     * @param string $key
     */
    public function setKey($key);

    /**
     * Retrieve the (transformed) value through this handler.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function get($value);
}
