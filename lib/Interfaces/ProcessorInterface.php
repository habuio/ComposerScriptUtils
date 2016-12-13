<?php

namespace Habu\ComposerScriptUtils\Interfaces;

use Composer\IO\IOInterface;
use Composer\Script\Event;

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
     * @param Event $event
     *
     * @return mixed
     */
    public function process(ConfigurationInterface $configuration, Event $event);
}
