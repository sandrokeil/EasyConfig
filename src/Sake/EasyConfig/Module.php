<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * This class initializes the EasyConfig module.
 */
class Module implements ConfigProviderInterface
{
    /**
     * Returns module config
     *
     * @return array
     */
    public function getConfig()
    {
        return require dirname(dirname(dirname(__DIR__))) . '/config/module.config.php';
    }
}
