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

class PostController extends AbstractActionController
{
    protected $categories;
    protected $postForm;
    use ListingsTableTrait;
    public function indexAction()
    {
        //return new ViewModel(['categories' => $this->categories]);
        
        $data = array();
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            // TODO: filtering / validation
            $this->postForm->setData($data);
            if ($this->postForm->isValid()) {
                // insert into the database
                // display success message
                // redirect
            }
        }
        $viewModel = new ViewModel([
            'categories' => $this->categories, 
            'postForm' => $this->postForm,
            'data' => $data
        ]);
        //$viewModel->setTemplate('market/post/invalid.phtml');
        return $viewModel;
    }
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }
    
    /**
     * @return the $postForm
     */
    public function getPostForm()
    {
        return $this->postForm;
    }

 /**
     * @param field_type $postForm
     */
    public function setPostForm($postForm)
    {
        $this->postForm = $postForm;
    }

}
