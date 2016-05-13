<?php
namespace Application\Plugin;

use DateTime;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ShowDate extends AbstractPlugin
{
    public function __invoke()
    {
        $date = new DateTime();
        return $date->format('Y-m-d H:i:s');
    }
}