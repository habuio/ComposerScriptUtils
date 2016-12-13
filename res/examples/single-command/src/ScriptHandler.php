<?php

namespace Habu\ComposerScriptExample;

use Composer\Script\Event;

class ScriptHandler
{
    public static function helloExample(Event $event)
    {
        $configuration = new Configuration($event->getComposer()->getPackage()->getExtra());
        $processor = new Processor($event->getIO(), $event->getComposer());

        $processor->process($configuration, $event);
    }
}
