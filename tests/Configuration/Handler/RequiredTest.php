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

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRequiredNull()
    {
        $this->handler->get(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRequiredFalse()
    {
        $this->handler->get(false);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRequiredEmptyArr()
    {
        $this->handler->get([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testKeyName()
    {
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