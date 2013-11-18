# AbstractConstructorOptionConfigFactory
Use this factory for easy dependency injection to your instance via constructor.

## Single constructor argument
Let's assume we have the following module configuration:

```php
return array(
    'cache_module' => array(
        'result_config' => array(
            'default' => array(
                'lifetime' => 50,
                'foo' => 'bar',
                ...
            )
        )
    )
    ...
);
```

We have also a class `ResultCache` with a single constructor argument like `public function __construct(array $config)`. So you can easily inject the above config to this class with this factory.


```php
use \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory;

class ResultCacheFactory extends AbstractConstructorOptionConfigFactory
{
    public function getModule()
    {
        return 'cache_module';
    }

    public function getScope()
    {
        return 'result_config';
    }

    public function getName()
    {
        return 'default';
    }

    protected function getInjectionType()
    {
        return self::INJECTION_TYPE_SINGLE;
    }

    public function getClassName()
    {
        return 'MyModule\Service\ResultCache';
    }
}
```

## Multiple constructor arguments
Let's assume we have the following module configuration:

```php
return array(
    'cache_module' => array(
        'result_config' => array(
            'default' => array(
                 // first constructor argument
                'first' => array(
                    'lifetime' => 50,
                    'foo' => 'bar',
                ),
                // second constructor argument
                'second' => array(
                    'bar' => 'foo',
                ),
                ...
            )
        )
    )
    ...
);
```

We have also a class `ResultCache` with two constructor arguments like `public function __construct(array $config, array $other)`. So you can easily inject the above config to this class with this factory.

```php
use \Sake\EasyConfig\Service\AbstractConstructorOptionConfigFactory;

class ResultCacheFactory extends AbstractConstructorOptionConfigFactory
{
    public function getModule()
    {
        return 'cache_module';
    }

    public function getScope()
    {
        return 'result_config';
    }

    public function getName()
    {
        return 'default';
    }

    protected function getInjectionType()
    {
        return self::INJECTION_TYPE_MULTI;
    }

    public function getClassName()
    {
        return 'MyModule\Service\ResultCache';
    }
}
```
