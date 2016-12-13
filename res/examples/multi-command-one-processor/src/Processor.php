<?php

namespace Habu\ComposerScriptExample;

use Composer\Script\Event;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

class Processor extends AbstractProcessor
{
    public function process(ConfigurationInterface $configuration, Event $event)
    {
        $this->getIO()->write($event->getName());
        $this->getIO()->write(sprintf('Hello %s!', $configuration->get('habu-script-example.name')));
    }
}
