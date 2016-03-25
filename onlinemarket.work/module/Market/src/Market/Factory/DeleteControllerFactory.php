<?php

namespace Market\Factory;

use Market\Controller\DeleteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DeleteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllers)
    {
        $sm = $controllers->getServiceLocator();
    	$controller = new DeleteController();
        $controller->setListingsTable($sm->get('market-listings-table'));
        $controller->setDeleteForm($sm->get('market-form-delete'));
        $controller->setDeleteFormFilter($sm->get('market-filter-delete'));
        return $controller;
    }
}
