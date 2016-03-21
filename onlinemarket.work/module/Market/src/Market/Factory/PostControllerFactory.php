<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\PostController;

class PostControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceManager = $controllerManager->getServiceLocator();
        $controller = new PostController();
        $controller->setCategories($serviceManager->get('categories'));
        return $controller;
    }
}