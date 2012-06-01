<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends BF_Model {

	protected $table		= "product";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_on";

	public function insertStockData($stock)
	{
		$this->db->insert('product_stock', $stock);

		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}

	public function insertImageData($image)
	{
		$this->db->insert('product_media', $image);

		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}
