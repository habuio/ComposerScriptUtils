<?php

namespace Habu\Tests\ComposerScriptUtils\Configuration;

use Habu\ComposerScriptUtils\Configuration\Handler\Required;
use Habu\ComposerScriptUtils\Interfaces\ConfigurationHandlerInterface;
use Habu\Tests\ComposerScriptUtils\Configuration\Concrete\EmptyConfiguration;
use Habu\Tests\ComposerScriptUtils\Configuration\Concrete\ExampleConfiguration;

class AbstractConfigurationTest extends \PHPUnit_Framework_TestCase
{
    private function invokeMethod($object, $methodName, array $params = [])
    {
        $reflection = new \ReflectionClass(get_class($object));

        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $params);
    }

    public function testRecursivelyBuildConfigurationDefaultsSingleDimensional()
    {
        $conf = new EmptyConfiguration([]);

        $res = $this->invokeMethod($conf, 'recursivelyBuildConfigurationDefaults', [
            'extras',
            [
                'example' => new Required()
            ]
        ]);

        $this->assertArrayHasKey('example', $res);
        $this->assertInstanceOf(ConfigurationHandlerInterface::class, $res['example']);

        $key = $this->invokeMethod($res['example'], 'getKey');
        $this->assertEquals('extras.example', $key);
    }

    public function testRecursivelyBuildConfigurationDefaultsMultiDimensional()
    {
        $conf = new EmptyConfiguration([]);

        $res = $this->invokeMethod($conf, 'recursivelyBuildConfigurationDefaults', [
            'extras',
            [
                'example' => [
                    'key1' => new Required()
                ]
            ]
        ]);

        $this->assertArrayHasKey('example', $res);
        $this->assertArrayHasKey('key1', $res['example']);
        $this->assertInstanceOf(ConfigurationHandlerInterface::class, $res['example']['key1']);

        $key = $this->invokeMethod($res['example']['key1'], 'getKey');
        $this->assertEquals('extras.example.key1', $key);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRecursivelyBuildConfigurationDefaultsException()
    {
        $conf = new EmptyConfiguration([]);

        $this->invokeMethod($conf, 'recursivelyBuildConfigurationDefaults', [
            'extras',
            [
                'example' => [
                    'key1' => 'klsdjflkdsfl'
                ]
            ]
        ]);

        $e = $this->getExpectedException();
        $this->assertEquals('Default configuration parameter extras.example.key1 is not an instance of AbstractHandler.', $e->getMessage());
    }

    public function testGetNodeByKey()
    {
        $conf = new EmptyConfiguration([]);

        $res = $this->invokeMethod($conf, 'getNodeByKey', [
            'test.bla.foo',
            [
                'test' => [
                    'bla' => [
                        'foo' => 'foo!'
                    ]
                ]
            ]
        ]);

        $this->assertEquals('foo!', $res);
    }

    public function testGetConfigValue()
    {
        $conf = new EmptyConfiguration([
            'example' => 'bla'
        ]);

        $res = $this->invokeMethod($conf, 'getConfigValue', ['example']);
        $this->assertEquals('bla', $res);
    }

    public function testGetDefault()
    {
        $conf = new ExampleConfiguration([]);

        $res = $this->invokeMethod($conf, 'getDefault', ['example.required-key']);
        $this->assertInstanceOf(Required::class, $res);
    }

    public function testBuildConfigurationDefaults()
    {
        $conf = new ExampleConfiguration([]);

        $defaults = $this->invokeMethod($conf, 'buildConfigurationDefaults', ['testing']);
        $handler = $defaults['example']['required-key'];

        $key = $this->invokeMethod($handler, 'getKey');
        $this->assertEquals('testing.example.required-key', $key);
    }

    public function testGetWithValidData()
    {
        $conf = new ExampleConfiguration([
            'example' => [
                'required-key' => 'bla',
            ]
        ]);

        $this->assertEquals('bla', $conf->get('example.required-key'));
        $this->assertEquals('default.value', $conf->get('example.default-value-key'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetWithMissingRequiredField()
    {
        $conf = new ExampleConfiguration([
            'example' => [

            ]
        ]);

        $this->assertEquals('bla', $conf->get('example.required-key'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetWithUndefinedDefault()
    {
        $conf = new ExampleConfiguration([
            'example' => [

            ]
        ]);

        $this->assertEquals('bla', $conf->get('example2'));
    }

    public function testGetConfigurationDefaults()
    {
        $conf = new ExampleConfiguration([]);
        $this->assertTrue(is_array($conf->getConfigurationDefaults()));
    }
}
