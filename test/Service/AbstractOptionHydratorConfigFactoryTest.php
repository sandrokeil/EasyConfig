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
 * Class AbstractOptionHydratorConfigFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractOptionHydratorConfigFactory
 */
class AbstractOptionHydratorConfigFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractOptionHydratorConfigFactory';

    /**
     * Tests createService() should inject options via hydrator
     *
     * @covers \Sake\EasyConfig\Service\AbstractOptionHydratorConfigFactory::createService
     */
    public function testCreateServiceWithHydrator()
    {
        $stub = $this->getConfigStub('setter');

        /* @var $instance \SakeTest\EasyConfig\Service\TestAsset\OptionConfig */
        $instance = $stub->createService($this->serviceManager);
        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig', $instance);

        $this->assertSame('bar', $instance->getBarFoo());
        $this->assertSame('foo', $instance->getFooBar());
    }

    /**
     * Returns configured stub for this test
     *
     * @param string $name Name
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getConfigStub($name)
    {
        $stub = parent::getStub($this->cut, 'sake_option', 'config', $name);

        $stub->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\OptionConfig'));
        $stub->expects($this->any())
            ->method('getHydrator')
            ->will($this->returnValue(new \Zend\Stdlib\Hydrator\ClassMethods()));
        return $stub;
    }
}
