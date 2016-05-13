<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'application-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/app',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            //'route'    => '/[:controller[/:action]',
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'showDate' => 'Application\Plugin\ShowDate',
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            /* Cannot cache an anonymous function within a config file.
             * 'config_cache_enabled' => TRUE in application.config.php on line 39.
             * Anonymous function added to Application/Module.php's getServiceConfig() method. 
             */  
            //'application-test' => function ($sm) { return 2+2; },
        ),
        'invokables' => array(
            'application-date' => 'DateTime',
        ),
        'shared' => array(
            'application-date' => FALSE,
        ),
        'aliases' => array(
            'categories' => 'application-categories',
        ),
        'services' => array(
            'application-who-wins' => 'WHO WINS: ' . __FILE__,    
            'application-who-adds' => ['B' => 'WHO ADDS: ' . __FILE__],    
            'application-categories' => [
                'barter',
                'beauty',
                'clothing',
                'computer',
                'entertainment',
                'free',
                'garden',
                'general',
                'health',
                'household',
                'phones',
                'property',
                'sporting',
                'tools',
                'transportation',
                'wanted'
            ],
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class
        ),
    ),
    'view_manager' => array(
        'strategies'               => ['ViewJsonStrategy'],
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        /*'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'application/index/foo'   => __DIR__ . '/../view/scripts/something/foo.phtml',
        ),*/
        'template_map'             => include __DIR__ . '/../template_map.php',
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
