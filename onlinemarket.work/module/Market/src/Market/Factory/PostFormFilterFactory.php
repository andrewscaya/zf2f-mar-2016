<?php

namespace Market\Factory;

use Market\Form\PostFormFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;

class PostFormFilterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $cityCodesTable = $sm->get('data-city-codes-table');
    	$filter = new PostFormFilter();
        $filter->setCityCodes($cityCodesTable->getAllCityCodesForForm());
        $filter->setCategories($sm->get('application-categories'));
        $filter->prepareFilters();
        return $filter;
    }
}
