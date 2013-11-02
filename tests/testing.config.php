<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/EasyConfig for the canonical source repository
 * @copyright Copyright (c) 2013 Sandro Keil
 * @license   http://github.com/sandrokeil/EasyConfig/blob/master/LICENSE.txt New BSD License
 */

return array(
    // service manager config example
    'sake_doctrine' => array( // module
        'orm_manager' => array( // scope
            'orm_default' => array( // name
                'invokables' => array( // config
                    'category' => 'Application\Service\Category',
                    'city' => 'Application\Service\City',
                ),
            ),
        ),
    ),
    'sake_config' => array(
        'connection' => array(
            'optionclass' => array(
                'bar' => 'bar',
                'foo' => 'foo',
            ),
        ),
    ),
    'sake_option' => array(
        'config' => array(
            'setter' => array(
                'barFoo' => 'bar',
                'fooBar' => 'foo',
            ),
            'constructor_multi' => array(
                'bar',
                'foo',
            ),
            'constructor' => 'bar',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'sake_easyconfig.service.foo' => '\SakeTest\EasyConfig\Service\TestAsset\OptionConfig',
            'sake_easyconfig.service.bar' => '\SakeTest\EasyConfig\Service\TestAsset\OptionConfig',
        )
    )
);
