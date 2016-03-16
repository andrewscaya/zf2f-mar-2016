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
use Zend\EventManager\GlobalEventManager;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        echo '<br>' . __METHOD__;
        //$em = $this->getEventManager();
        //$em->setIdentifiers('xyz');
        GlobalEventManager::trigger('whatever', $this, ['abc' => 'GLOBAL']);
        $today = $this->getServiceLocator()->get('application-date');
        $tomorrow = $this->getServiceLocator()->get('application-date');
        $tomorrow->add(new \DateInterval('P1D'));
        echo '<br>' . $today->format('Y-m-d H:i:s');
        echo '<br>' . $tomorrow->format('Y-m-d H:i:s');
        echo '<br>' . $this->getServiceLocator()->get('application-who-wins');
        \Zend\Debug\Debug::dump($this->getServiceLocator()->get('application-who-adds'));
        return new ViewModel();
    }
}
