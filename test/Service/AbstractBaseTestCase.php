<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class ServiceTestCase
 *
 * Main test case class for service test classes
 */
abstract class AbstractBaseTestCase extends TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var ModuleLoader
     */
    protected $moduleLoader;

    /**
     * Setup tests
     */
    public function setUp()
    {
        parent::setUp();

        // Load the user-defined test configuration file, if it exists; otherwise, load default
        if (is_readable('test/TestConfig.php')) {
            $testConfig = require 'test/testing.config.php';
        } else {
            $testConfig = require 'test/testing.config.php.dist';
        }

        $this->serviceManager = new ServiceManager(new Config(
            [
                'invokables' => [
                    'sake_easyconfig.service.foo' => '\SakeTest\EasyConfig\Service\TestAsset\OptionConfig',
                    'sake_easyconfig.service.bar' => '\SakeTest\EasyConfig\Service\TestAsset\OptionConfig',
                ]
            ]
        ));
        $this->serviceManager->setService('Configuration', $testConfig);
    }

    /**
     * Returns configured stub for testing
     *
     * @param $cut
     * @param string $module
     * @param string $scope
     * @param string $name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getStub($cut, $module = 'sake_doctrine', $scope = 'orm_manager', $name = 'orm_default')
    {
        $stub = $this->getMockForAbstractClass($cut);
        $stub->expects($this->any())
            ->method('getModule')
            ->will($this->returnValue($module));

        $stub->expects($this->any())
            ->method('getScope')
            ->will($this->returnValue($scope));

        $stub->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($name));

        return $stub;
    }
}
