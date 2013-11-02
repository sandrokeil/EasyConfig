# AbstractConfigFactory

 Use this class if you want to retrieve the configuration options and setup your instance manually.

Let's assume we have the following configuration:

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

## Array Options
Then you have easily access to the `orm_default` options in your createService() method with this factory.

```php
use Sake\EasyConfig\Service\AbstractConfigFactory;

class MyDBALConnectionFactory extends AbstractConfigFactory
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
## Option Class
If you implement `OptionClassInterface` then you get a option class. Your options class should extend from `\Zend\Stdlib\AbstractOptions`.
```
use \Sake\EasyConfig\Service\OptionClassInterface;

class MyDBALConnectionFactory extends AbstractConfigFactory implements OptionClassInterface
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

    public function getOptionClass()
    {
        return '\DoctrineORMModule\Options\DBALConnection';
    }
}
```
