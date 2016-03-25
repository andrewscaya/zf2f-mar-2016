<?php
return [
    'controllers' => [
        'factories' => [
            'market-index-controller'  => 'Market\Factory\IndexControllerFactory',
            'market-view-controller'   => 'Market\Factory\ViewControllerFactory',
            'market-post-controller'   => 'Market\Factory\PostControllerFactory',
            'market-delete-controller' => 'Market\Factory\DeleteControllerFactory',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'market-form-post'      => 'Market\Factory\PostFormFactory',
            'market-form-delete'    => 'Market\Factory\DeleteFormFactory',
            'market-filter-post'    => 'Market\Factory\PostFilterFactory',
            'market-filter-delete'  => 'Market\Factory\DeleteFilterFactory',
            'market-listings-table' => 'Market\Factory\ListingsTableFactory',
        ],
        'services' => [
            'market-expire-days' => [ 
                0  => 'Never', 
                1  => 'Tomorrow', 
                7  => 'Week', 
                30 => 'Month'
            ],
            'market-cities' => [
                'Paris,FR'     => 'Paris',
                'London,UK'    => 'London',
                'New York,US'  => 'New York',
                'Berlin,DE'    => 'Berlin'
            ],
            'market-captcha-options' => [
                'expiration' => 300,
                'font'		=> '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
                'fontSize'	=> 24,
                'height'	=> 50,
                'width'		=> 200,
                'imgDir'	=> __DIR__ . '/../../../public/captcha',
                'imgUrl'	=> '/captcha',    	
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller'    => 'market-index-controller',
                        'action'        => 'index',
                        'module'        => 'market',
                    ],
                ],
            ],
            'market' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/market',
                    'defaults' => [
                        'controller'    => 'market-index-controller',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'view' => [
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/view',
                            'defaults' => [
                                'controller'    => 'market-view-controller',
                                'action'        => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'index' => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                'options' => [
                                    'route'    => '/main[/:category]',
                                    'defaults' => [
                                        'action' => 'index',
                                    ],
                                    'constraints' => [
                                        'category' => '[a-zA-Z]*',
                                    ],
                                ],
                            ],
                            'item' => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                'options' => [
                                    'route'    => '/item[/:itemId]',
                                    'defaults' => [
                                        'action'        => 'item',
                                    ],
                                    'constraints' => [
                                        'itemId' => '[0-9]*',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'post' => [
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/post',
                            'defaults' => [
                                'controller'    => 'market-post-controller',
                                'action'        => 'index',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller'    => 'market-delete-controller',
                                'action'        => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'confirm' => [
                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                'options' => [
                                    'route'    => '/confirm[/:itemId[/:delCode]]',
                                    'defaults' => [
                                        'action' => 'confirm',
                                    ],
                                    'constraints' => [
                                        'itemId'  => '[0-9]*',
                                        'delCode' => '[0-9]*',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'leftLinks' => 'Market\Helper\LeftLinks',    
        ], 
    ],
    'view_manager' => [
        'template_map' => include __DIR__ . '/../template_map.php',
    ],
];
