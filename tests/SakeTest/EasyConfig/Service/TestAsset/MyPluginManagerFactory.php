<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service\TestAsset;

use Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory;

class MyPluginManagerFactory extends AbstractServiceManagerConfigFactory
{
    public function getModule()
    {
        return 'sake_doctrine';
    }

    public function getScope()
    {
        return 'orm_manager';
    }

    public function getName()
    {
        return 'orm_default';
    }

    public function getClassName()
    {
        return '\SakeTest\EasyConfig\Service\TestAsset\MyPluginManager';
    }

    public function getOptionClass()
    {
        return '\SakeTest\EasyConfig\Service\TestAsset\MyPluginManagerOptions';
    }
}
