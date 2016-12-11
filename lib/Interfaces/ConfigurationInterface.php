<?php

namespace Habu\ComposerScriptUtils\Interfaces;

/**
 * Interface ConfigurationInterface.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
interface ConfigurationInterface
{
    /**
     * ConfigurationInterface constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs);

    /**
     * Retrieve a configuration value.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key);
}
