<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013-2014 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service;

use SakeTest\EasyConfig\Util\AbstractBaseTestCase as BaseTestCase;
use \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory;

/**
 * Class AbstractConstructorOptionConfigFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory
 */
class AbstractConstructorOptionConfigFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory';

    /**
     * Tests createService() should inject option via constructor
     *
     * @covers \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory::createService
     */
    public function testCreateServiceWithConstructor()
    {
        $stub = $this->getConfigStub('constructor', AbstractConstructorOptionConfigFactory::INJECTION_TYPE_SINGLE);

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance);

        $this->assertSame('bar', $instance->getFoo());
        $this->assertSame(null, $instance->getBar());
    }

    /**
     * Tests createService() should inject option via constructor
     *
     * @covers \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory::createService
     */
    public function testCreateServiceWithConstructorMulti()
    {
        $stub = $this->getConfigStub(
            'constructor_multi',
            AbstractConstructorOptionConfigFactory::INJECTION_TYPE_MULTI
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
     * @param int $type Injection type
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
