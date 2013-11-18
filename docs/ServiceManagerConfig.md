# AbstractServiceManagerConfigFactory
This factory injects options to a service manager instance via a service manager config class. This is useful for plugin manager.
Let's assume we have the following configuration:

```php
return array(
    'mymodule' => array(
        'orm_manager' => array(
            'orm_default' => array(
                'invokables' => array(
                    // '[short name]' => 'FCQN of doctrine service'
                ),
            ),
        ),
    ),
);
```
You can easily create a configured plugin manager with these options easily. The repository is injected via constructor. See test assets for details.

```php
use Sake\EasyConfig\Service\AbstractServiceManagerConfigFactory;

class MyOrmManagerFactory extends AbstractServiceManagerConfigFactory
{
    public function getClassName()
    {
        return 'MyModule\Service\OrmManager';
    }

    public function getModule()
    {
        return 'mymodule';
    }

    public function getScope()
    {
        return 'orm_manager';
    }

    public function getName()
    {
        return 'orm_default';
    }

    public function getOptionClass()
    {
        return 'MyModule\Service\Options\OrmManagerOptions';
    }
}
```
