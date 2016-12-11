<?php

namespace Habu\ComposerScriptUtils\Configuration;

use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationHandlerInterface;

/**
 * Class AbstractConfiguration.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    /**
     * @const string
     */
    const EXTRAS_KEY = 'extras';

    /**
     * @var array
     */
    private $configs;

    /**
     * @var array
     */
    private $defaults;

    /**
     * AbstractConfiguration constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs)
    {
        $this->configs = $configs;
        $this->defaults = $this->buildConfigurationDefaults(self::EXTRAS_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $val = $this->getConfigValue($key);
        $default = $this->getDefault($key);

        if (is_null($default)) {
            throw new \InvalidArgumentException(sprintf('Configuration key %s is not defined in the defaults', $key));
        }

        return $default->get($val);
    }

    /**
     * Compile configuration defaults.
     *
     * @param string $key
     *
     * @return array|ConfigurationHandlerInterface
     */
    private function buildConfigurationDefaults($key)
    {
        $defaults = $this->getConfigurationDefaults();

        return $this->recursivelyBuildConfigurationDefaults($key, $defaults);
    }

    /**
     * Recursively build and validate our configuration defaults.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return array
     */
    private function recursivelyBuildConfigurationDefaults($key, $value)
    {
        $data = [];

        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $data[$k] = $this->recursivelyBuildConfigurationDefaults($key . '.' . $k, $v);
            }
        } else {
            if (!$value instanceof ConfigurationHandlerInterface) {
                throw new \InvalidArgumentException(sprintf('Default configuration parameter %s is not an instance of AbstractHandler.', $key));
            }

            $value->setKey($key);
            $data = $value;
        }

        return $data;
    }

    /**
     *Retrieve a value by dot-notated key from a multi-dimensional array.
     *
     * @param string $key
     * @param array $arr
     *
     * @return mixed
     */
    private function getNodeByKey($key, $arr)
    {
        $key = explode('.', $key);

        $ref = $arr;

        foreach ($key as $part) {
            if (!isset($ref[$part])) {
                return null;
            } else {
                $ref = $ref[$part];
            }
        }

        return $ref;
    }

    /**
     * Retrieve a value by dot-notated key from our configuration array.
     *
     * @param string $key
     * @return mixed
     */
    private function getConfigValue($key)
    {
        return $this->getNodeByKey($key, $this->configs);
    }

    /**
     * Retrieve a value by dot-notated key from our defaults array.
     *
     * @param string $key
     * @return mixed
     */
    private function getDefault($key)
    {
        return $this->getNodeByKey($key, $this->defaults);
    }

    /**
     * Define the configuration defaults.
     * You must implement this in your concrete implementation class.
     *
     * @return mixed
     */
    abstract protected function getConfigurationDefaults();
}
