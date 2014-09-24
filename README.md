# EasyConfig module for Zend Framework 2

> You want to configure your factories via your module config?

> You want to configure option classes via module config for your plugin manager?

> You want to add other services via module config to a factory?

> This module comes to the rescue!

[![Build Status](https://travis-ci.org/sandrokeil/EasyConfig.png?branch=master)](https://travis-ci.org/sandrokeil/EasyConfig)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/badges/quality-score.png?s=cdef161c14156e3e36ed0ce3d6fd7979d38d916c)](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/)
[![Coverage Status](https://coveralls.io/repos/sandrokeil/EasyConfig/badge.png?branch=master)](https://coveralls.io/r/sandrokeil/EasyConfig?branch=master)
[![HHVM Status](http://hhvm.h4cc.de/badge/sandrokeil/easy-config.svg)](http://hhvm.h4cc.de/package/sandrokeil/easy-config)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c7092bbe-8dc2-473d-9c13-617f41b2375b/mini.png)](https://insight.sensiolabs.com/projects/c7092bbe-8dc2-473d-9c13-617f41b2375b)
[![Latest Stable Version](https://poser.pugx.org/sandrokeil/easy-config/v/stable.png)](https://packagist.org/packages/sandrokeil/easy-config)
[![Dependency Status](https://www.versioneye.com/user/projects/53615c75fe0d0720eb00009e/badge.png)](https://www.versioneye.com/user/projects/53615c75fe0d0720eb00009e)
[![Total Downloads](https://poser.pugx.org/sandrokeil/easy-config/downloads.png)](https://packagist.org/packages/sandrokeil/easy-config)
[![License](https://poser.pugx.org/sandrokeil/easy-config/license.png)](https://packagist.org/packages/sandrokeil/easy-config)

EasyConfig provides some abstract factories and some interfaces to easily create instances depending on configuration or retrieve specified module options.

 * **Well tested.** Besides unit test and continuous integration/inspection this solution is also ready for production use.
 * **Great foundations.** Based on [Zend Framework 2](https://github.com/zendframework/zf2)
 * **Every change is tracked**. Want to know whats new? Take a look at [CHANGELOG.md](https://github.com/sandrokeil/EasyConfig/blob/master/CHANGELOG.md)
 * **Listen to your ideas.** Have a great idea? Bring your tested pull request or open a new issue.

You should have coding conventions and you should have config conventions. If not, you should think about that.

The module config keys should have the following structure `module.scope.name`.  A common configuration looks like that:

```php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(...)
            )
        )
    )
);
```

So `doctrine` is the module, `connection` is the scope and `orm_default` is the name. After that the specified instance options follow.
With [AbstractConfigurableFactory](docs/Configurable.md) we can easily access to these options also with an option class and mandatory options check. See [docs](docs/Configurable.md) for a detailed explanation.

```php
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Sake\EasyConfig\Service\OptionsClassInterface;
use Sake\EasyConfig\Service\MandatoryOptionsInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyDBALConnectionFactory extends AbstractConfigurableFactory implements FactoryInterface, OptionsClassInterface, MandatoryOptionsInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // get option class for doctrine.connection.orm_default
        // dont implement OptionsClassInterface to get an array of options
        $options = $this->getOptions($serviceLocator);

        // so you can do
        $pdo          = $options->getPdo();
        $driverClass  = $options->getDriverClass();
        $wrapperClass = $options->getWrapperClass();

        // create your instance

        return $instance;
    }

    /**
     * Returns a list of mandatory options which must be available
     *
     * @return array
     */
    public function getMandatoryOptions()
    {
        return array(
            'driverClass',
            'params',
        );
    }

    /**
     * Return the option class name (fcqn) where options are injected via constructor
     *
     * @return string
     */
    public function getOptionsClass()
    {
        return '\DoctrineORMModule\Options\DBALConnection';
    }

    /**
     * Module name
     *
     * @return string
     */
    public function getModule()
    {
        return 'doctrine';
    }

    /**
     * Config scope
     *
     * @return string
     */
    public function getScope()
    {
        return 'connection';
    }

    /**
     * Config name
     *
     * @return string
     */
    public function getName()
    {
        return 'orm_default';
    }
}
```

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Put the following into your composer.json

    {
        "require": {
            "sandrokeil/easy-config": "~1.0"
        }
    }

It is *not necessary* to add this module to your `config/application.config.php`.

## Documentation

You can find documentation about the usages of factories at the following links:

 * [Configurable - Get an options class or an array of options with mandytoy](docs/Configurable.md)
 * [ConstructorOptionConfig - Inject options via constructor](docs/ConstructorOptionConfig.md)
 * [OptionHydratorConfig - Inject options with a hydrator](docs/OptionHydratorConfig.md)
 * [ServiceConfig - Inject an other service to instance](docs/ServiceConfig.md)
 * [ServiceManagerConfig - Inject Options to a service plugin manager](docs/ServiceManagerConfig.md)
 * [ServiceOptionConfig - Inject one or more services](docs/ServiceOptionConfig.md)

