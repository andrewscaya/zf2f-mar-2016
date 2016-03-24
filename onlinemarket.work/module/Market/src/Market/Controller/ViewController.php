<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Market for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{
    protected $adapter;
    public function indexAction()
    {
        $category = $this->params()->fromRoute('category');
        $list = $this->adapter->query('SELECT * FROM listings WHERE category = ?', [$category]);
        return new ViewModel(['category' => $category, 'list' => $list]);
    }

    public function itemAction()
    {
        $itemId = $this->params()->fromRoute('itemId');
        if (!$itemId) {
            $this->flashMessenger()->addMessage('Item Not Found');
            return $this->redirect()->toRoute('market');
        }
        return new ViewModel(['itemId' => $itemId]);
    }
    /**
     * @return the $adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

 /**
     * @param field_type $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

}
