<?php
namespace Market\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
class ListingsTable extends TableGateway
{
    const TABLE_NAME  = 'listings';
    const PRIMARY_KEY = 'listings_id';

    public function getListingById($id)
    {
        return $this->select([self::PRIMARY_KEY => $id])->current();
    }
    
    public function getListingsByCategory($category)
    {
        return $this->select(['category' => $category]);
    }
    
    public function getMostRecentListing()
    {
        // SELECT * FROM listings 
        // ORDER BY listings_id DESC
        // LIMIT 1
        $sql = new Sql($this->getAdapter());
        $select = $sql->select();
        $select->from(self::TABLE_NAME)
               ->order(self::PRIMARY_KEY . ' DESC')
               ->limit(1);
        return $this->selectWith($select)->current();
    }

    public function getListingsOrderByTitle()
    {
        // SELECT * FROM listings 
        // ORDER BY title ASC
        $sql = new Sql($this->getAdapter());
        $select = $sql->select();
        $select->from(self::TABLE_NAME)
               ->order('title ASC');
        return $this->selectWith($select);
    }

    public function getListingsForDeleteForm()
    {
        $listings = array();
        foreach ($this->getListingsOrderByTitle() as $listing) {
            $listings[$listing[self::PRIMARY_KEY]] = $listing->title;
        }
        return $listings;
    }

	/**
	 * Takes data from form, runs it through a mapper
	 * and then calls TableGateway::insert()
     * 
     * NOTE: $data is passed by reference
     *       formToTableMapping() will create a new delete code
	 *
	 * @param array $data
	 * @return int # rows affected (s/be 1)
	 */
	public function save(&$data)
	{
        $data = $this->formToTableMapping($data);
		return $this->insert($data);
	}
		
    /**
     * Takes form data and returns database row data
     * -- calculates expiration date using DateTime::add(DateInterval)
     * -- generates a delete code
     * 
     * @param array $formData
     * @return array $rowData
     */
    public function formToTableMapping($formData)
    {
        $rowData = array();
        if (isset($formData['category'])) {
            $rowData['category'] = $formData['category'];
        }
        if (isset($formData['title'])) {
            $rowData['title'] = $formData['title'];
        }
        if (isset($formData['photoFilename'])) {
            $rowData['photo_filename'] = $formData['photoFilename'];
        }
        if (isset($formData['price'])) {
            $rowData['price'] = $formData['price'];
        }
        if (isset($formData['expires'])) {
            $date = new \DateTime('now');
            if ($formData['expires']) {
                $date->add(new \DateInterval('P' . (int) $formData['expires'] . 'D'));
                $rowData['date_expires'] = $date->format('Y-m-d');
            } else {
                $rowData['date_expires'] = NULL;
            }
        }
        if (isset($formData['cityCountry'])) {
            list($rowData['city'],$rowData['country']) = explode(',', $formData['cityCountry']);
        }
        if (isset($formData['contactName'])) {
            $rowData['contact_name'] = $formData['contactName'];
        }
        if (isset($formData['contactPhone'])) {
            $rowData['contact_phone'] = $formData['contactPhone'];
        }
        if (isset($formData['contactEmail'])) {
            $rowData['contact_email'] = $formData['contactEmail'];
        }
        if (isset($formData['description'])) {
            $rowData['description'] = $formData['description'];
        }
        // generate delete code
        $rowData['delete_code'] = sprintf('%06d', rand(0,999999));
        return $rowData;
    }
    
    public function deleteByDeleteCode($deleteCode, $id)
    {
		$listing = $this->getListingById($id);
		if ($listing && ($delCode == $item->delete_code)) {
			return $this->delete([self::PRIMARY_KEY => $id]);
		} else {
			return FALSE;
		}
	}
	
}
