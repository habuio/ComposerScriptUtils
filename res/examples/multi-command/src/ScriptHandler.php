<?php

namespace Habu\ComposerScriptExample;

use Composer\Script\Event;
use Habu\ComposerScriptExample\Processor\ExampleProcessor;
use Habu\ComposerScriptExample\Processor\HelloProcessor;

class ScriptHandler
{
    private static function buildConfiguration($extra)
    {
        return new Configuration($extra);
    }

    public static function helloExample(Event $event)
    {
        $configuration = self::buildConfiguration($event->getComposer()->getPackage()->getExtra());
        $processor = new HelloProcessor($event->getIO(), $event->getComposer());

        $processor->process($configuration, $event);
    }

    public static function genericExample(Event $event)
    {
        $configuration = self::buildConfiguration($event->getComposer()->getPackage()->getExtra());
        $processor = new ExampleProcessor($event->getIO(), $event->getComposer());

        $processor->process($configuration, $event);
    }
}
