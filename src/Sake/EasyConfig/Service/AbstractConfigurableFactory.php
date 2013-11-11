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

/**
 * AbstractConfigurableFactory which retrieves configuration options
 *
 * Use this class if you want to retrieve the configuration options and setup your instance manually.
 */
abstract class AbstractConfigurableFactory implements ConfigurableInterface
{
    /**
     * Gets options from configuration based on module.scope.name.
     *
     * @param  ServiceLocatorInterface $sl
     * @throws Exception\RuntimeException
     * @return mixed Array or Option class
     */
    public function getOptions(ServiceLocatorInterface $sl)
    {
        $options = $sl->get('Configuration');

        if (empty($options[$this->getModule()])) {
            throw new Exception\RuntimeException(sprintf('No configuration "%s" available.', $this->getModule()));
        }

        if (!isset($options[$this->getModule()][$this->getScope()][$this->getName()])) {
            throw new Exception\RuntimeException(sprintf(
                'Options with name "%s" could not be found in configuration "%s.%s".',
                $this->getName(),
                $this->getModule(),
                $this->getScope()
            ));
        }
        $options = $options[$this->getModule()][$this->getScope()][$this->getName()];

        // create option class
        if ($this instanceof OptionClassInterface) {
            $optionClass = $this->getOptionClass();
            $options = new $optionClass($options);
        }
        return $options;
    }
}
