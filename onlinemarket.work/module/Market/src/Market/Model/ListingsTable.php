<?php
namespace Market\Model;

use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway
{
    const TABLE_NAME = 'listings';

    //SELECT * FROM listings WHERE category = ?
    public function getListingsByCategory($category)
    {
        //$where = $this->getListingsTable()->getSql()->select()->where();
        //$where->equalTo('category', $category);
        //$where->in(xxxx)->and->like(xxxx)->or->not->xxxxxxxx;
        return $this->select(['category' => $category]);        
    }

    //SELECT * FROM listings WHERE listings_id = ?
    public function getListingsById($id)
    {
        return $this->select(['listings_id' => $id])->current();
    }

}
