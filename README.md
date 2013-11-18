# EasyConfig module for Zend Framework 2
[![Build Status](https://travis-ci.org/sandrokeil/EasyConfig.png?branch=master)](https://travis-ci.org/sandrokeil/EasyConfig)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/badges/quality-score.png?s=cdef161c14156e3e36ed0ce3d6fd7979d38d916c)](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/)
[![Code Coverage](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/badges/coverage.png?s=2637df033bd48a1edb7e2d85e994b26cd4d862a2)](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/)
[![Latest Stable Version](https://poser.pugx.org/sandrokeil/easy-config/v/stable.png)](https://packagist.org/packages/sandrokeil/easy-config)
[![Total Downloads](https://poser.pugx.org/sandrokeil/easy-config/downloads.png)](https://packagist.org/packages/sandrokeil/easy-config)

Easy config provides some abstract factories to easily create instances depending on configuration or retrieve specified module options.

You should have coding conventions and you should have config conventions. If not, you should think about that.

With this module config keys should have the following structure `module.scope.name`.  A common configuration looks like that:

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
So `doctrine` is the module, `connection` is the scope and `orm_default` is the name. After that follows the specified instance options.
With [AbstractConfigurableFactory](https://github.com/sandrokeil/EasyConfig/tree/master/docs/Configurable.md) we have access to these options easily.

```php
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyDBALConnectionFactory extends AbstractConfigurableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // get options for doctrine.connection.orm_default
        $options = $this->getOptions($serviceLocator);

        $driverClass = $options['driverClass'];
        $params = $options['params'];

        // create your instance and set options

        return $instance;
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
            "sandrokeil/easy-config": "dev-master"
        }
    }

Then add `Sake\EasyConfig` to your `config/application.config.php` at the first module.

## Documentation

You can find documentation about the usages of factories at the following links:

 * [Configurable](https://github.com/sandrokeil/EasyConfig/tree/master/docs/Configurable.md)
 * [ConstructorOptionConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ConstructorOptionConfig.md)
 * [OptionHydratorConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/OptionHydratorConfig.md)
 * [ServiceConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceConfig.md)
 * [ServiceManagerConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceManagerConfig.md)
 * [ServiceOptionConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceOptionConfig.md)

