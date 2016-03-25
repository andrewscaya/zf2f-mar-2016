<?php
return [
    'db' => [
        'driver' => 'PDO',
        'dsn'    => 'mysql:dbname=onlinemarket;host=localhost',
        'username' => 'zend',
        'password' => 'password',
        'driver_options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    ], 
    'service_manager' => [
        'factories' => [
            'general-adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',    
            /*
             * Normally you do not want anonymous functions in config!!!
            'another-adapter' => function ($sm) {
                return new Zend\Db\Adapter\Adapter($sm->get('db-1'));
            }
            */
        ],
        'services' => [
            'db-1' => [
                'driver' => 'PDO',
                'dsn'    => 'mysql:dbname=onlinemarket;host=localhost',
                'username' => 'zend',
                'password' => 'password',
                'driver_options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
            ],
        ],
    ],
];