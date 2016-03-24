<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\ViewController;

class ViewControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceManager = $controllerManager->getServiceLocator();
        $controller = new ViewController();
        $controller->setAdapter($serviceManager->get('general-adapter'));
        return $controller;
    }
}