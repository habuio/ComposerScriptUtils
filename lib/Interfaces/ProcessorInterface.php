<?php

namespace Habu\ComposerScriptUtils\Interfaces;

use Composer\IO\IOInterface;

/**
 * Interface ProcessorInterface
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
interface ProcessorInterface
{
    /**
     * Run the processor.
     *
     * @param ConfigurationInterface $configuration
     * @return mixed
     */
    public function process(ConfigurationInterface $configuration);
}
