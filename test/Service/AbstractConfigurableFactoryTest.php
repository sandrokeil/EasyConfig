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
 * Class AbstractConfigurableFactoryTest
 *
 * Tests integrity of \Sake\EasyConfig\Service\AbstractConfigurableFactory
 */
class AbstractConfigurableFactoryAbstractBaseTest extends BaseTestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Service\AbstractConfigurableFactory';

    /**
     * Tests getOptions() should throw exception if no config is available
     *
     * @covers \Sake\EasyConfig\Service\AbstractConfigurableFactory::getOptions
     */
    public function testGetOptionsShouldThrowRuntimeExceptionIfNoConfigIsAvailable()
    {
        $stub = parent::getStub($this->cut, 'invalid_module');

        $this->setExpectedException('\Sake\EasyConfig\Service\Exception\RuntimeException', 'No configuration');

        $stub->getOptions($this->serviceManager);
    }

    /**
     * Tests getOptions() should throw exception if no option is available
     *
     * @covers \Sake\EasyConfig\Service\AbstractConfigurableFactory::getOptions
     */
    public function testGetOptionsShouldThrowRuntimeExceptionIfNoOptionIsAvailable()
    {
        $stub = parent::getStub($this->cut, 'sake_doctrine', 'orm_manager', 'invalid');

        $this->setExpectedException('\Sake\EasyConfig\Service\Exception\RuntimeException', 'Options with name');

        $stub->getOptions($this->serviceManager);
    }

    /**
     * Tests if getOptions() works as expected
     *
     * @covers \Sake\EasyConfig\Service\AbstractConfigurableFactory::getOptions
     */
    public function testGetOptionsShouldReturnExpectedData()
    {
        $stub = parent::getStub($this->cut);

        $this->assertArrayHasKey('invokables', $stub->getOptions($this->serviceManager));
    }

    /**
     * Tests if getOptions() works with an option class
     *
     * @covers \Sake\EasyConfig\Service\AbstractConfigurableFactory::getOptions
     */
    public function testGetOptionsShouldReturnOptionClass()
    {
        $stub = parent::getStub(
            '\SakeTest\EasyConfig\Service\TestAsset\AbstractOptionClassFactory',
            'sake_config',
            'connection',
            'optionclass'
        );

        $stub->expects($this->any())
            ->method('getOptionsClass')
            ->will($this->returnValue('\SakeTest\EasyConfig\Service\TestAsset\OptionClass'));

        /* @var $optionsClass \SakeTest\EasyConfig\Service\TestAsset\OptionClass */
        $optionsClass = $stub->getOptions($this->serviceManager);

        $this->assertInstanceOf('\SakeTest\EasyConfig\Service\TestAsset\OptionClass', $optionsClass);
        $this->assertSame('foo', $optionsClass->getFoo());
        $this->assertSame('bar', $optionsClass->getBar());
    }
}
