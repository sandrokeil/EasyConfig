# AbstractConfigurableFactory

Use this class if you want to retrieve the configuration options and setup your instance manually.

Let's assume we have the following module configuration:

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
    ...
);
```

## Array Options
Then you have easily access to the `orm_default` options in your `createService()` method with this factory.

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

## Mandatory Options check
You can also check for mandatory options automatically with `MandatoryOptionsInterface`. Now we want also check that
option `driverClass` and `params` are available. So we also implement in the example above the interface
`MandatoryOptionsInterface`. If one of these options is missing, an exception is raised.

```php
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Sake\EasyConfig\Service\MandatoryOptionsInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyDBALConnectionFactory extends AbstractConfigurableFactory implements FactoryInterface, MandatoryOptionsInterface
{
    // same code as above

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
}
```
This can also be combined with `OptionsClassInterface`

## Option Class
If you implement `OptionClassInterface` then you get a option class. Your options class should extend from `\Zend\Stdlib\AbstractOptions`.
```
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Sake\EasyConfig\Service\OptionsClassInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyDBALConnectionFactory extends AbstractConfigurableFactory implements FactoryInterface, OptionsClassInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // get option class for doctrine.connection.orm_default
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
