# AbstractServiceConfigFactory
This factory injects another service with module.scope.name via service locator to instance.
Let's assume we have the following configuration:

```php
return array(
    'service_manager' => array(
        'factories' => array(
            'mymodule.naviagtion.container' => 'MyContainerFactory',
        )
    )
);
```

Then you can easily create a menu view helper with navigation container which was injected via service locator. This is only an example, normally you would get this view helper with `\Zend\View\Helper\Navigation\PluginManager`.

```php
use \Sake\EasyConfig\Service\AbstractServiceConfigFactory

class MyViewHelperFactory extends AbstractServiceConfigFactory
{
    public function getClassName()
    {
        return '\Zend\View\Helper\Navigation\Menu';
    }

    public function getModule()
    {
       return 'mymodule';
    }

    public function getScope()
    {
        return 'navigation';
    }

    public function getName()
    {
        return 'container';
    }

    public function getInjectionMethod()
    {
        return 'setContainer';
    }

}
```
