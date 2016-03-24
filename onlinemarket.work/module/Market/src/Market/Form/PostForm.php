<?php
namespace Market\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PostForm extends Form
{
    protected $categories;
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    public function buildForm()
    {
        // define category and title form elements
        $category = new Element\Select('category');
        // TODO: inject categories from service manager 
        //       we will do this in the form service manager factory
        $category->setValueOptions(array_combine($this->categories,$this->categories));
        $category->setAttribute('title', 'Please choose a category');
        $category->setLabel('Category');
        $this->add($category);
        
        $title = new Element\Text('title');
        $title->setAttributes(['placeholder' => 'Enter Title', 'maxLength' => '128']);
        $title->setLabel('Title');
        $this->add($title);
        
        $submit = new Element\Submit('submit');
        $submit->setAttributes(['value' => 'Post']);
        $this->add($submit);
    }
}