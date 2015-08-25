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
 * AbstractConstructorOptionConfigFactory which injects configuration options to instance via constructor
 *
 * Use this factory for easy dependency injection in your instance via constructor.
 */
abstract class AbstractConstructorOptionConfigFactory extends AbstractConfigurableFactory implements ClassNameInterface,
 FactoryInterface
{
    /**
     * Injects option via constructor
     */
    const INJECTION_TYPE_SINGLE = 1;

    /**
     * Injects options via constructor
     */
    const INJECTION_TYPE_MULTI = 2;

    /**
     * Create an configured instance depending on options via constructor
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $this->getOptions($serviceLocator);

        $reflection = new \ReflectionClass($this->getClassName());

        switch ($this->getInjectionType()) {
            case self::INJECTION_TYPE_MULTI:
                $instance = $reflection->newInstanceArgs($options);
                break;
            default:
            case self::INJECTION_TYPE_SINGLE:
                $instance = $reflection->newInstanceArgs(array($options));
                break;
        }
        return $instance;
    }

    /**
     * Return injection type for this factory, use INJECTION_TYPE_* constant.
     *
     * @return int
     */
    abstract protected function getInjectionType();
}
