<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\EventManager\GlobalEventManager;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        echo '<br>' . __METHOD__;
        //$em = $this->getEventManager();
        /* 
         * Corresponding code : Application\Module.php on line 30.
         * Alternate trigger : Test\Module.php on line 20.
         * This trigger will not work unless we use a SEM (or GlobalEventManager class)
         * because the controller's EM is a different one from the one we use in the Module class (init vs. bootstrap phases of the app).
         * Please note that this static call to the SEM (GlobalEventManager) is deprecated as of ZF 2.5.1 and will be removed as of 3.0.
         */
        //$em->setIdentifiers('xyz');
        //$em->trigger('whatever', $this, ['abc' => 'ABC']);
        GlobalEventManager::trigger('whatever', $this, ['abc' => 'GLOBAL']);
        
        /* NOTE : The ServiceLocatorAwareInterface (getServiceLocator() method) is deprecated as of ZF 2.5.1 and will be removed as of 3.0. */
        $today = $this->getServiceLocator()->get('application-date');
        $tomorrow = $this->getServiceLocator()->get('application-date');
        $tomorrow->add(new \DateInterval('P1D'));
        echo '<br>' . $this->url()->fromRoute('search-test', ['name' => 'TEST']);
        echo '<br>' . $today->format('Y-m-d H:i:s');
        echo '<br>' . $tomorrow->format('Y-m-d H:i:s');
        echo '<br>' . $this->getServiceLocator()->get('application-who-wins');
        //\Zend\Debug\Debug::dump($this->getServiceLocator()->get('application-who-adds'));
        echo '<br>' . $this->getServiceLocator()->get('application-test');
        \Zend\Debug\Debug::dump($this->getServiceLocator()->get('ApplicationConfig'));
        $test = $this->params()->fromQuery('test');
        return new ViewModel(['test' => $test]);
    }
    
    public function fooAction()
    {
        /*
        $topLeft = new ViewModel();
        $topLeft->setTemplate('application/widgets/top_left');
        $lowerLeft = new ViewModel();
        $lowerLeft->setTemplate('application/widgets/lower_left');
        */
        
        $data = ['apple' => 'Apple', 'banana' => 'Banana'];
        //return $data;
        
        $viewModel = new ViewModel($data);
        //$viewModel->setTemplate('application/index/foo.php');
        //$viewModel->setTemplate('scripts/foo.php');
        //$viewModel->setTerminal(TRUE);
        //$viewModel->addChild($topLeft, 'topLeft');
        //$viewModel->addChild($lowerLeft, 'lowerLeft');
        return $viewModel;
    }

    public function jsonAction()
    {
        $data = ['apple' => 'Apple', 'banana' => 'Banana'];
        $jsonModel = new JsonModel($data);
        return $jsonModel;
    }
    
}
