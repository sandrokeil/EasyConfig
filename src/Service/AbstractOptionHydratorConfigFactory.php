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
 * AbstractOptionHydratorConfigFactory which injects configuration options to instance via hydrator
 *
 * Use this factory for easy dependency injection in your instance via hydrator.
 */
abstract class AbstractOptionHydratorConfigFactory extends AbstractConfigurableFactory implements ClassNameInterface,
 FactoryInterface
{
    /**
     * Create an configured instance depending on options
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $className = $this->getClassName();
        $instance  = new $className();
        $this->getHydrator($serviceLocator)->hydrate($this->getOptions($serviceLocator), $instance);
        return $instance;
    }

    /**
     * Return hydrator for options. With service locator you can use the hydrator plugin manager.
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \Zend\Stdlib\Hydrator\HydratorInterface
     */
    abstract public function getHydrator(ServiceLocatorInterface $serviceLocator);
}
