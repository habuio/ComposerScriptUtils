<?php

namespace Habu\ComposerScriptExample\Processor;

use Composer\Script\Event;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

class HelloProcessor extends AbstractProcessor
{
    public function process(ConfigurationInterface $configuration, Event $event)
    {
        $this->getIO()->write(sprintf('Hello, %s!', $configuration->get('habu-script-example.name')));
    }
}
