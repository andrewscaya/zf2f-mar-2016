<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\DeleteForm;

class DeleteFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $table = $sm->get('market-listings-table');
        $form = new DeleteForm();
        $form->setItemsForForm($table->getListingsForDeleteForm());
        $form->buildForm();
        return $form;
    }
}
