<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig;

/**
 * Class ModuleTest
 *
 * Tests integrity of \Sake\EasyConfig\Module
 */
class ModuleTest extends \SakeTest\Util\TestCase
{
    /**
     * Class under test
     *
     * @var string
     */
    protected $cut = '\Sake\EasyConfig\Module';

    /**
     * Tests getConfig() should should return module configuration
     *
     * @covers \Sake\EasyConfig\Module::getConfig
     */
    public function testGetConfig()
    {
        $cut = new $this->cut;
        $config = $cut->getConfig();
        $this->assertSame(array(), $config, 'Configuration could not be read');
    }
}
