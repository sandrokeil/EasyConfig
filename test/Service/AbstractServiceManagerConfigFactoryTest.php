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
 * Class ServiceManagerConfigFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory
 */
class AbstractServiceManagerConfigFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory';

    /**
     * Concrete class
     *
     * @var string
     */
    protected $cc = '\SakeTest\EasyConfig\Service\TestAsset\MyPluginManagerFactory';

    /**
     * Tests createService() should throw runtime exception if no config instance was created
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory::createService
     */
    public function testCreateServiceShouldThrowRuntimeExceptionIfOptionClassIsWrong()
    {
        $stub = $this->getConfigStub('\SakeTest\EasyConfig\Service\TestAsset\InvalidClass');

        $this->setExpectedException('\Sake\EasyConfig\Service\Exception\RuntimeException', 'Option class');

        $stub->createService($this->serviceManager);
    }

    /**
     *  Tests getOptions() should return expected option class
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory::getOptions
     */
    public function testGetOptionsShouldReturnConfigInstance()
    {
        $stub = $this->getConfigStub();

        $this->assertInstanceOf(
            '\SakeTest\EasyConfig\Service\TestAsset\MyPluginManagerOptions',
            $stub->getOptions($this->serviceManager)
        );
    }

    /**
     * Tests createService() should do his job
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory::createService
     * @depends testGetOptionsShouldReturnConfigInstance
     */
    public function testCreateServiceReturnsService()
    {
        $cut = new $this->cc;
        $instance = $cut->createService($this->serviceManager);

        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\MyPluginManager', $instance);
    }

    /**
     * Tests createService() if no service manager instance was created
     *
     * @covers \Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory::createService
     * @depends testGetOptionsShouldReturnConfigInstance
     */
    public function testCreateServiceShouldThrowRuntimeExceptionIfIsNoServiceManagerInstance()
    {
        $stub = $this->getConfigStub();
        $stub->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\InvalidClass'));

        $this->setExpectedException('\Sake\EasyConfig\Service\Exception\RuntimeException', 'Class ');

        $stub->createService($this->serviceManager);
    }

    /**
     * Returns configured stub for testing
     *
     * @param string $configClass
     * @param string $module
     * @param string $scope
     * @param string $name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConfigStub(
        $configClass = '\SakeTest\EasyConfig\Service\TestAsset\MyPluginManagerOptions',
        $module = 'sake_doctrine',
        $scope = 'orm_manager',
        $name = 'orm_default'
    ) {
        $stub = parent::getStub($this->cut, $module, $scope, $name);

        $stub->expects($this->any())
            ->method('getOptionsClass')
            ->will($this->returnValue($configClass));

        return $stub;
    }
}
