<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\EasyConfig\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * AbstractOptionConfigFactory which injects configuration options to instance
 *
 * Use this factory for easy dependency injection in your instance via hydrator or constructor.
 */
abstract class AbstractOptionConfigFactory extends AbstractConfigFactory implements ClassNameInterface
{
    /**
     * Uses hydrator to inject options to instance
     */
    const INJECTION_TYPE_HYDRATOR = 0;

    /**
     * Injects option via constructor
     */
    const INJECTION_TYPE_CONSTRUCTOR = 1;

    /**
     * Injects options via constructor
     */
    const INJECTION_TYPE_CONSTRUCTOR_MULTI = 2;

    /**
     * Create an configured instance depending on options
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator);

        switch ($this->getInjectionType()) {
            case self::INJECTION_TYPE_CONSTRUCTOR:
            case self::INJECTION_TYPE_CONSTRUCTOR_MULTI:
                $reflection = new \ReflectionClass($this->getClassName());

                $instance = $reflection->newInstanceArgs(
                    // more than one parameter
                    self::INJECTION_TYPE_CONSTRUCTOR_MULTI == $this->getInjectionType() ? $options : array($options)
                );
                break;
            case self::INJECTION_TYPE_HYDRATOR:
            default:
                $className = $this->getClassName();
                $instance = new $className();
                $this->getHydrator($serviceLocator)->hydrate($options, $instance);
                break;
        }
        return $instance;
    }

    /**
     * Override this method to return specialized hydrator
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ClassMethods
     */
    protected function getHydrator(ServiceLocatorInterface $serviceLocator)
    {
        return new ClassMethods();
    }

    /**
     * Return injection type for this factory, use INJECTION_TYPE_* constant.
     *
     * @return int
     */
    abstract protected function getInjectionType();
}
