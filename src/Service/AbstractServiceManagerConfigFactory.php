<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Sake\EasyConfig\Service\Exception;

/**
 * AbstractServiceManagerConfigFactory uses a service manager config class to configure a service manager instance.
 *
 * This factory injects options to a service manager instance via a service manager config class. This is useful for
 * plugin manager.
 */
abstract class AbstractServiceManagerConfigFactory extends AbstractConfigurableFactory implements OptionsClassInterface,
 ClassNameInterface, FactoryInterface
{
    /**
     * Creates a configured service/plugin manager instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\RuntimeException
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $optionClass = $this->getOptions($serviceLocator);

        if (!$optionClass instanceof \Zend\ServiceManager\ConfigInterface) {
            throw new Exception\RuntimeException(
                sprintf(
                    'Option class "%s" must implement %s for this factory.',
                    $this->getOptionsClass(),
                    '\Zend\ServiceManager\ConfigInterface'
                )
            );
        }

        $className = $this->getClassName();
        $instance  = new $className($optionClass);

        if (!$instance instanceof \Zend\ServiceManager\ServiceManager) {
            throw new Exception\RuntimeException(
                sprintf(
                    'Class "%s" is not an instance of %s',
                    $this->getClassName(),
                    '\Zend\ServiceManager\ServiceManager'
                )
            );
        }
        return $instance;
    }
}
