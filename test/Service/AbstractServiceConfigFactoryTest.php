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

/**
 * Class AbstractServiceConfigFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractServiceConfigFactory
 */
class AbstractServiceConfigFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractServiceConfigFactory';

    /**
     * Tests createService() should inject another service depending on module.scope.name
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceConfigFactory::createService
     */
    public function testCreateService()
    {
        $stub = $this->getConfigStub('foo');

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionClass', $instance);

        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance->getFoo());
    }

    /**
     * Tests createService() should inject another service depending on module.scope.name from plugin manager
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceConfigFactory::createService
     */
    public function testCreateServiceWithPluginManager()
    {
        $stub = $this->getConfigStub('foo');

        $pluginManager = new \SakeTest\EasyConfig\Service\TestAsset\MyPluginManager();
        $pluginManager->setServiceLocator($this->serviceManager);

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($pluginManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionClass', $instance);

        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance->getFoo());
    }

    /**
     * Returns configured stub for this test
     *
     * @param string $name Name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConfigStub($name)
    {
        $stub = parent::getStub($this->cut, 'sake_easyconfig', 'service', $name);

        $stub->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\OptionClass'));
        $stub->expects($this->any())
            ->method('getInjectionMethod')
            ->will($this->returnValue('setFoo'));
        return $stub;
    }
}
