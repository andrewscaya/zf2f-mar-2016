<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\PostForm;

class PostFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $form = new PostForm();
        $form->setCategories($serviceManager->get('categories'));
        $form->buildForm();
        $form->setInputFilter($serviceManager->get('market-post-filter'));
        return $form;
    }
}