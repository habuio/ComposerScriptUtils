<?php

namespace Habu\Tests\ComposerScriptUtils\Processor;

use Composer\Composer;
use Composer\IO\IOInterface;
use Habu\Tests\ComposerScriptUtils\Configuration\Concrete\ExampleConfiguration;
use Habu\Tests\ComposerScriptUtils\Processor\Concrete\ExampleProcessor;

class AbstractProcessorTest extends \PHPUnit_Framework_TestCase
{
    private $io;
    private $composer;

    /**
     * @var ExampleProcessor
     */
    private $processor;

    private function invokeMethod($object, $methodName, array $params = [])
    {
        $reflection = new \ReflectionClass(get_class($object));

        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $params);
    }

    public function setUp()
    {
        $this->io = $this->prophesize(IOInterface::class);
        $this->composer = $this->prophesize(Composer::class);

        $this->processor = new ExampleProcessor($this->io->reveal(), $this->composer->reveal());
    }

    public function testGetIO()
    {
        $res = $this->invokeMethod($this->processor, 'getIO');
        $this->assertInstanceOf(IOInterface::class, $res);
    }

    public function testGetComposer()
    {
        $res = $this->invokeMethod($this->processor, 'getComposer');
        $this->assertInstanceOf(Composer::class, $res);
    }

    public function testProcess()
    {
        // $this->processor->process(new ExampleConfiguration([]));
    }
}
