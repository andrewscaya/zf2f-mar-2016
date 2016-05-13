<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\PostController;

class PostControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $sm = $controllerManager->getServiceLocator();
        $controller = new PostController();
        $categories = $sm->get('application-categories');
        $controller->setCategories($categories);
        // inject form into controller
        $controller->setPostForm($sm->get('market-form-post'));
        $controller->setListingsTable($sm->get('market-listings-table'));
        $controller->setSession($sm->get('application-session'));
        return $controller;
    }
}
