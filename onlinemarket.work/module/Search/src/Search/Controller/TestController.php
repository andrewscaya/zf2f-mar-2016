<?php
namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{
	
	public function indexAction()
    {
	    //$response = $this->getResponse();
	    
	    //$response->setContent('<h1>Eeverything is under control. Do not panic!</h1>');
	    
	    //$data = [1, 2, 3, 4, 5, 'test' => 'TEST'];
	    //$response->setContent(json_encode($data));
	    
	    //return $response;
	    
        return new ViewModel(array(	'test' => $this->showDate()));
    }

}
