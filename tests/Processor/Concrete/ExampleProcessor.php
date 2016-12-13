<?php

namespace Habu\Tests\ComposerScriptUtils\Processor\Concrete;

use Composer\Script\Event;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationInterface;
use Habu\ComposerScriptUtils\Processor\AbstractProcessor;

class ExampleProcessor extends AbstractProcessor
{
    public function process(ConfigurationInterface $configuration, Event $event)
    {
    }
}
