# AbstractOptionHydratorConfigFactory
Use this factory for easy dependency injection in your instance via hydrator.

Let's assume we have the following module configuration:

```php
return array(
    'mymodule' => array(
        'myscope' => array(
            'default' => array(
                 // setter/getter available for foo, time and date_format
                'foo' => 'bar',
                'time' => 5,
                'date_format' => 'Y-m-d'
            )
        )
    )
    ...
);
```

You can easily inject the above options to an instance with this factory.

```php
use Sake\EasyConfig\Service\AbstractOptionHydratorConfigFactory;

class ResultCacheFactory extends AbstractOptionHydratorConfigFactory
{
    public function getModule()
    {
        return 'mymodule';
    }

    public function getScope()
    {
        return 'myscope';
    }

    public function getName()
    {
        return 'default';
    }

    public function getClassName()
    {
        return 'MyModule\Service\ClassWithSetter';
    }

    public function getHydrator(ServiceLocatorInterface $serviceLocator)
    {
        // use service locator to retrieve other hydrators
        return new \Zend\Stdlib\Hydrator\ClassMethods();
    }
}
```
