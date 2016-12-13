<?php

namespace Habu\ComposerScriptExample\Processor;

use Composer\Script\Event;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

class ExampleProcessor extends AbstractProcessor
{
    public function process(ConfigurationInterface $configuration, Event $event)
    {
        $this->getIO()->write(sprintf('This is an %s', $configuration->get('habu-script-example.example')));
    }
}
