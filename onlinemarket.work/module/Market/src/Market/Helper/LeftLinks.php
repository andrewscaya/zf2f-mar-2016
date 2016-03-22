<?php
namespace Market\Helper;

use Zend\View\Helper\AbstractHelper;
class LeftLinks extends AbstractHelper
{
    public function __invoke($categories, $prefix)
    {
        // TODO: loop through the categories
        //       <li><a href="/market/view/main/<category>">category</a></li>
        return $prefix . ':' . var_export($categories, TRUE);
    }
}