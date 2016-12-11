<?php

namespace Habu\Tests\ComposerScriptUtils\Configuration\Handler;

use Habu\ComposerScriptUtils\Configuration\Handler\DefaultValue;

class DefaultValueTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultValueHandler()
    {
        $handler = new DefaultValue('test');

        // Assert that empty values return the default value
        // attached to the handler.
        $this->assertEquals('test', $handler->get(null));
        $this->assertEquals('test', $handler->get(false));
        $this->assertEquals('test', $handler->get([]));

        // Assert that non-empty values return the
        // provided value.
        $this->assertEquals('bla', $handler->get('bla'));
        $this->assertEquals('0', $handler->get('0'));
    }
}