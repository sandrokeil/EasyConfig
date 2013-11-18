# AbstractServiceOptionConfigFactory
This factory injects one or more services (configured in service manager) via a method to instance.

Let's assume we have the following configuration:

```php
return array(
    'mymodule' => array(
        'myscope' => array(
            'default' => array(
                 // all these services are defined in service manager config
                'mymodule.service.one',
                'mymodule.service.two',
                'mymodule.service.three',
                'mymodule.service.four',
            )
        )
    )
);
```

You can easily inject the above services to an instance with this factory.

```php
use Sake\EasyConfig\Service\AbstractServiceOptionConfigFactory;

class ContainerFactory extends AbstractServiceOptionConfigFactory
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
        return 'MyModule\Service\ClassWithServiceStack';
    }

    public function getInjectionMethod()
    {
        return 'add';
    }
}
```
