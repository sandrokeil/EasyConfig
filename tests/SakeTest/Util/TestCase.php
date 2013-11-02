<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\Util;

use SakeTest\Bootstrap;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * Setup tests
     */
    public function setUp()
    {
        parent::setUp();
        $this->serviceManager = Bootstrap::getServiceManager();
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
