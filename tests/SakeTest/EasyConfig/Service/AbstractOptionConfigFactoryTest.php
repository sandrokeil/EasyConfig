<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service;

use \Sake\EasyConfig\Service\AbstractOptionConfigFactory;

/**
 * Class AbstractOptionConfigFactory
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractOptionConfigFactory
 */
class AbstractOptionConfigFactoryTest extends \SakeTest\Util\TestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractOptionConfigFactory';

    /**
     * Tests createService() should inject options via hydrator
     *
     * @covers \Sake\EasyConfig\Service\AbstractOptionConfigFactory::createService
     * @covers \Sake\EasyConfig\Service\AbstractOptionConfigFactory::getHydrator
     */
    public function testCreateServiceWithHydrator()
    {
        $stub = $this->getConfigStub('setter', AbstractOptionConfigFactory::INJECTION_TYPE_HYDRATOR);

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance);

        $this->assertSame('bar', $instance->getBarFoo());
        $this->assertSame('foo', $instance->getFooBar());
    }

    /**
     * Tests createService() should inject option via constructor
     *
     * @covers \Sake\EasyConfig\Service\AbstractOptionConfigFactory::createService
     */
    public function testCreateServiceWithConstructor()
    {
        $stub = $this->getConfigStub('constructor', AbstractOptionConfigFactory::INJECTION_TYPE_CONSTRUCTOR);

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance);

        $this->assertSame('bar', $instance->getFoo());
        $this->assertSame(null, $instance->getBar());
    }

    /**
     * Tests createService() should inject option via constructor
     *
     * @covers \Sake\EasyConfig\Service\AbstractOptionConfigFactory::createService
     */
    public function testCreateServiceWithConstructorMulti()
    {
        $stub = $this->getConfigStub(
            'constructor_multi',
            AbstractOptionConfigFactory::INJECTION_TYPE_CONSTRUCTOR_MULTI
        );

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance);

        $this->assertSame('bar', $instance->getFoo());
        $this->assertSame('foo', $instance->getBar());
    }

    /**
     * Returns configured stub for this test
     *
     * @param string $name Name
     * @param $type Injectin type
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConfigStub($name, $type)
    {
        $stub = parent::getStub($this->cut, 'sake_option', 'config', $name);

        $stub->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig'));
        $stub->expects($this->any())
            ->method('getInjectionType')
            ->will($this->returnValue($type));
        return $stub;
    }
}
