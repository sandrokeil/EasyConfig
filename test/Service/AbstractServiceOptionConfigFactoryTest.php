<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service;

use SakeTest\EasyConfig\Service\AbstractBaseTestCase as BaseTestCase;

/**
 * Class AbstractServiceConfigFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractServiceOptionConfigFactory
 */
class AbstractServiceOptionConfigFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractServiceOptionConfigFactory';

    /**
     * Tests createService() should inject another services
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceOptionConfigFactory::createService
     */
    public function testCreateServiceWithServices()
    {
        $stub = $this->getConfigStub('services');

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\Container */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\Container', $instance);

        $services = $instance->getServices();

        $this->assertArrayHasKey(0, $services);
        $this->assertArrayHasKey(1, $services);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $services[0]);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $services[1]);
    }

    /**
     * Tests createService() should inject another service
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceOptionConfigFactory::createService
     */
    public function testCreateServiceWithService()
    {
        $stub = $this->getConfigStub('service');

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\Container */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\Container', $instance);

        $services = $instance->getServices();

        $this->assertArrayHasKey(0, $services);
        $this->assertArrayNotHasKey(1, $services);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $services[0]);
    }

    /**
     * Returns configured stub for this test
     *
     * @param string $name Name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConfigStub($name)
    {
        $stub = parent::getStub($this->cut, 'sake_service_option_config', 'container', $name);

        $stub->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\Container'));
        $stub->expects($this->any())
            ->method('getInjectionMethod')
            ->will($this->returnValue('add'));
        return $stub;
    }
}
