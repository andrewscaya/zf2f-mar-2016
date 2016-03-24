<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\PostFilter;

class PostFilterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $filter = new PostFilter();
        $filter->setCategories($serviceManager->get('categories'));
        $filter->buildFilters();
        return $filter;
    }
}