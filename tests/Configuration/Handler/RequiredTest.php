<?php

namespace Habu\Tests\ComposerScriptUtils\Configuration\Handler;

use Habu\ComposerScriptUtils\Configuration\Handler\Required;

class RequiredTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Required
     */
    private $handler;

    public function setUp()
    {
        $this->handler = new Required();
    }

    public function testRequiredNull()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->handler->get(null);
    }

    public function testRequiredFalse()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->handler->get(false);
    }

    public function testRequiredEmptyArr()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->handler->get([]);
    }

    public function testKeyName()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->handler->setKey('extras.example.bla');
        $this->handler->get(0);

        $e = $this->getExpectedException();
        $this->assertEquals('Configuration key extras.example.bla is required.', $e->getMessage());
    }

    public function testRequiredWithValues()
    {
        $this->assertEquals('test', $this->handler->get('test'));
        $this->assertEquals(3, $this->handler->get(3));
        $this->assertEquals('0', $this->handler->get('0'));
    }
}