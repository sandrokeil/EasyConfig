# EasyConfig module for Zend Framework 2
[![Build Status](https://travis-ci.org/sandrokeil/EasyConfig.png?branch=master)](https://travis-ci.org/sandrokeil/EasyConfig)
[![Coverage Status](https://coveralls.io/repos/sandrokeil/EasyConfig/badge.png)](https://coveralls.io/r/sandrokeil/EasyConfig)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/badges/quality-score.png?s=cdef161c14156e3e36ed0ce3d6fd7979d38d916c)](https://scrutinizer-ci.com/g/sandrokeil/EasyConfig/)

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


## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Put the following into your composer.json

    {
        "require": {
            "sandrokeil/easy-config": "*"
        }
    }

Then add `Sake\EasyConfig` to your `config/application.config.php`.

## Documentation

You can find documentation about the usages of factories at the following links:

 * [Configurable](https://github.com/sandrokeil/EasyConfig/tree/master/docs/Configurable.md)
 * [ConstructorOptionConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ConstructorOptionConfig.md)
 * [OptionHydratorConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/OptionHydratorConfig.md)
 * [ServiceConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceConfig.md)
 * [ServiceManagerConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceManagerConfig.md)
 * [ServiceOptionConfig](https://github.com/sandrokeil/EasyConfig/tree/master/docs/ServiceOptionConfig.md)

