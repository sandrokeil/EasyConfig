<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\EasyConfig\Service\TestAsset;

use Zend\ServiceManager\AbstractPluginManager;

class MyPluginManager extends AbstractPluginManager
{
    /**
     * Entity manager name
     *
     * @var string
     */
    protected $entityManager;

    /**
     * Sets entity manager name
     *
     * @param $entityManager
     * @return MyPluginManager
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
        return $this->entityManager;
    }

    /**
     * Retrieves the repository from entity manager and set them to createOptions to inject repository to invokable.
     *
     * @param string $canonicalName
     * @param string $requestedName
     * @return mixed ORM service
     */
    protected function createFromInvokable($canonicalName, $requestedName)
    {
        // get your entity class name build from invokable class name
        $entityClassName = '';

        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager = $this->getServiceLocator()->get($this->getEntityManager());

        // get repository
        $this->creationOptions = $entityManager->getRepository($entityClassName);

        // create service with doctrine repository constructor dependency
        $service = parent::createFromInvokable($canonicalName, $requestedName);
        $this->creationOptions = null;
        return $service;
    }

    /**
     * Validate the plugin
     *
     * Checks that the orm service loaded is either a valid callback or an instance of ServiceOrmInterface.
     *
     * @param  mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        // do nothing here, only for test
        return;
    }
}
