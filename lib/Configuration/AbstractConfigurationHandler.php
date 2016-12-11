<?php

namespace Habu\ComposerScriptUtils\Configuration;

use Habu\ComposerScriptUtils\Interfaces\ConfigurationHandlerInterface;

/**
 * Class AbstractConfigurationHandler.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
abstract class AbstractConfigurationHandler implements ConfigurationHandlerInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * {@inheritdoc}
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function get($value);
}
