<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * AbstractServiceConfigFactory which injects another service to instance
 *
 * This factory injects another service with module.scope.name via service locator to instance.
 */
abstract class AbstractServiceConfigFactory implements FactoryInterface, ConfigurableInterface, ClassNameInterface,
 InjectionMethodInterface
{
    /**
     * Create an configured instance where an other service (module.scope.name) is injected.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $className = $this->getClassName();
        $method    = $this->getInjectionMethod();
        $service   = sprintf('%s.%s.%s', $this->getModule(), $this->getScope(), $this->getName());

        $instance = new $className();

        if ($serviceLocator instanceof AbstractPluginManager) {
            $instance->$method($serviceLocator->getServiceLocator()->get($service));
        } else {
            $instance->$method($serviceLocator->get($service));
        }
        return $instance;
    }
}
