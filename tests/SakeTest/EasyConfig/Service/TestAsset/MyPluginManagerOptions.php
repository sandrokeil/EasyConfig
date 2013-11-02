<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service\TestAsset;

use Zend\Stdlib\AbstractOptions;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

class MyPluginManagerOptions extends AbstractOptions implements ConfigInterface
{
    /**
     * @var array
     */
    protected $invokables = array();

    /**
     * Configuration key is assembled as "doctrine.entity_manager.{key}" and pulled from service locator.
     *
     * @var string
     */
    protected $entityManager = 'orm_default';

    /**
     * Sets invokables
     *
     * @param array $invokables
     * @return $this
     */
    public function setInvokables(array $invokables)
    {
        $this->invokables = $invokables;
        return $this;
    }

    /**
     * Returns invokables
     *
     * @return array
     */
    public function getInvokables()
    {
        return $this->invokables;
    }

    /**
     * Sets entity manager name
     *
     * @param string $entityManager
     * @return MyPluginManagerOptions
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * Returns entity manager name
     *
     * @return string
     */
    public function getEntityManager()
    {
        return 'doctrine.entity_manager.' . $this->entityManager;
    }

    /**
     * Configure service manager
     *
     * @param ServiceManager $serviceManager
     * @return void
     */
    public function configureServiceManager(ServiceManager $serviceManager)
    {
        foreach ($this->invokables as $name => $class) {
            $serviceManager->setInvokableClass($name, $class);
        }
        $serviceManager->setEntityManager($this->getEntityManager());
    }
}
