<?php
namespace Market\Form;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Filter\StringTrim;
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class PostFilter extends InputFilter
{
    protected $categories;
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    public function buildFilters()
    {
        // define category and title form elements
        $category = new Input('category');
        $category->getFilterChain()
                ->attach(new StringTrim())
                ->attachByName('StripTags');
        $category->getValidatorChain()
                 ->attach(new InArray(['haystack' => $this->categories]));
        $this->add($category);
        
        $title = new Input('title');
        $title->getFilterChain()
                ->attach(new StringTrim())
                ->attachByName('StripTags');
        $title->getValidatorChain()
              ->attach(new NotEmpty())
              ->attach(new StringLength(['min' => 1, 'max'=> 128]));
        $this->add($title);
        
    }
}