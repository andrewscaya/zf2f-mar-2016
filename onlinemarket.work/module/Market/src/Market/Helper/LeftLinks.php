<?php
namespace Market\Helper;

use Zend\View\Helper\AbstractHelper;
class LeftLinks extends AbstractHelper
{
    public function __invoke($categories, $prefix)
    {
        $output = '';
        if (is_array($categories) && count($categories)) {
            $output .= '<ul>';
            foreach ($categories as $item) {
                $href = str_replace('//', '/', $prefix . '/' . $item);
                $output .= sprintf('<li><a href="%s">%s</a></li>', $href, ucfirst($item));
            }
            $output .= '</ul>';
        }
        return $output;
    }
}