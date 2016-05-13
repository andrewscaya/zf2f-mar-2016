<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\GlobalEventManager;
use Zend\EventManager\AbstractListenerAggregate;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        /* Corresponding code : Test\Module.php on line 20. */
        //$eventManager->attach('whatever', function ($e) { echo '<br /><h1>WHATEVER' . $e->getParam('abc') . '</h1>'; });
        //$eventManager->trigger('someotherevent', $this);
        
        /* Corresponding code : Application\Controller\IndexController.php on line 29. */ 
        //$sharedMgr = $eventManager->getSharedManager();
        //$sharedMgr->attach('xyz', 'whatever', function ($e) { echo '<br /><h1>WHATEVER' . $e->getParam('abc') . '</h1>'; });
        
        /* Corresponding code : if setIdentifiers() is not set in Application\Controller\IndexController.php on line 29. */
        //$sharedMgr->attach('*', 'whatever', [$this, 'whateverListener']);
        
        /* Corresponding code : Application\Controller\IndexController.php on line 31. */
        GlobalEventManager::attach('whatever', [$this, 'whateverListener']);
        
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);
    }

    public function whateverListener($e)
    {
        echo '<br>' . __METHOD__ . ':' . $e->getParam('abc');
    }
    
    public function onDispatch(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $viewModel = $e->getViewModel();
        $viewModel->setVariable('categories', $sm->get('categories'));
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return [
            'initializers' => [
                'application-test-1' => function ($instance, $sm) {
                    if ($instance instanceof AbstractListenerAggregate) {
                        //echo '<br>' . get_class($instance);
                    }
                },
                'application-test-2' => function ($instance, $sm) {
                    //echo '<br>#2 ran also!';
                }
            ],    
            'services' => [
                'application-who-wins' => 'WHO WINS: ' . __FILE__,    
                'application-who-adds' => ['A' => 'WHO ADDS: ' . __FILE__],    
            ],
            'factories' => [
                'application-test' => function ($sm) { return 2+2; },
            ],
        ];
    }
    
}
