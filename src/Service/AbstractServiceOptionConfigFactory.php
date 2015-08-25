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

/**
 * AbstractServiceOptionConfigFactory injects other service(s) via a method
 *
 * This factory injects one or more services (configured in service locator) via a method to instance.
 */
abstract class AbstractServiceOptionConfigFactory extends AbstractConfigurableFactory implements FactoryInterface,
 InjectionMethodInterface, ClassNameInterface
{
    /**
     * Creates a configured instance where a list of services are injected via one method depending on options
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator);

        $className = $this->getClassName();
        $method    = $this->getInjectionMethod();
        $instance  = new $className();

        if (is_array($options)) {
            foreach ($options as $service) {
                $instance->$method($serviceLocator->get($service));
            }
        } else {
            $instance->$method($serviceLocator->get($options));
        }
        return $instance;
    }
}
