<?php

namespace Habu\ComposerScriptExample;

use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

class Processor extends AbstractProcessor
{
    public function process(ConfigurationInterface $configuration)
    {
        $this->getIO()->write(sprintf('Hello %s!', $configuration->get('habu-script-example.name')));
    }
}
