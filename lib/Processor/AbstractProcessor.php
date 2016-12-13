<?php

namespace Habu\ComposerScriptUtils\Processor;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Script\Event;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Interfaces\ProcessorInterface;

/**
 * Class AbstractProcessor.
 *
 * @author Ruben Knol <c.minor6@gmail.com>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @var Composer
     */
    private $composer;


    public function __construct(IOInterface $io, Composer $composer)
    {
        $this->io = $io;
        $this->composer = $composer;
    }

    /**
     * @return IOInterface
     */
    protected function getIO()
    {
        return $this->io;
    }

    /**
     * @return Composer
     */
    protected function getComposer()
    {
        return $this->composer;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function process(ConfigurationInterface $configuration, Event $event);
}
