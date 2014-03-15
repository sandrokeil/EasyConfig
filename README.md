# EasyConfig module for Zend Framework 2
[![Build Status](https://travis-ci.org/sandrokeil/EasyConfig.png?branch=master)](https://travis-ci.org/sandrokeil/EasyConfig)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/badges/quality-score.png?s=cdef161c14156e3e36ed0ce3d6fd7979d38d916c)](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/)
[![Coverage Status](https://coveralls.io/repos/sandrokeil/EasyConfig/badge.png?branch=master)](https://coveralls.io/r/sandrokeil/EasyConfig?branch=master)
[![Latest Stable Version](https://poser.pugx.org/sandrokeil/easy-config/v/stable.png)](https://packagist.org/packages/sandrokeil/easy-config)
[![Dependency Status](https://www.versioneye.com/user/projects/53245667ec13758e7d00014b/badge.png)](https://www.versioneye.com/user/projects/53245667ec13758e7d00014b)
[![Total Downloads](https://poser.pugx.org/sandrokeil/easy-config/downloads.png)](https://packagist.org/packages/sandrokeil/easy-config)

Easy config provides some abstract factories to easily create instances depending on configuration or retrieve specified module options.

You should have coding conventions and you should have config conventions. If not, you should think about that.

This module config keys should have the following structure `module.scope.name`.  A common configuration looks like that:

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
With [AbstractConfigurableFactory](https://github.com/sandrokeil/EasyConfig/tree/master/docs/Configurable.md) we can easily access to these options also with an option class.

```php
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Sake\EasyConfig\Service\OptionsClassInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyDBALConnectionFactory extends AbstractConfigurableFactory implements FactoryInterface, OptionsClassInterface
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

    public function getOptionsClass()
    {
        return '\DoctrineORMModule\Options\DBALConnection';
    }

    public function getModule()
    {
        return 'doctrine';
    }

    public function getScope()
    {
        return 'connection';
    }

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

Then add `Sake\EasyConfig` to your `config/application.config.php` at the first module.

## Documentation

You can find documentation about the usages of factories at the following links:

 * [Configurable - Get an options class or an array of options](https://github.com/sandrokeil/EasyConfig/tree/master/docs/Configurable.md)
 * [ConstructorOptionConfig - Inject options via constructor](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ConstructorOptionConfig.md)
 * [OptionHydratorConfig - Inject options with a hydrator](https://github.com/sandrokeil/EasyConfig/tree/master/docs/OptionHydratorConfig.md)
 * [ServiceConfig - Inject an other service to instance](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceConfig.md)
 * [ServiceManagerConfig - Inject Options to a service plugin manager](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceManagerConfig.md)
 * [ServiceOptionConfig - Inject one or more services](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceOptionConfig.md)

