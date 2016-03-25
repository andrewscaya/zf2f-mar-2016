<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\DeleteFilter;
use Market\Model\ListingsTable;

class DeleteFilterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $filter = new DeleteFilter();
        $filter->setDbValidatorParams(
            [
                'table'   => ListingsTable::TABLE_NAME, 
                'field'   => ListingsTable::PRIMARY_KEY,
                'adapter' => $sm->get('general-adapter')
            ]
        );
        $filter->buildFilter();
        return $filter;
    }
}
