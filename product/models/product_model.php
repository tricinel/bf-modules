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

	public function deleteProduct($id,$product_sku,$product_images)
	{
		//delete product from product table
		$this->db->where(array('id' => $id));
		$this->db->delete('product');

		//delete product stock information
		$this->db->where(array('product_sku' => $product_sku));
		$this->db->delete('product_stock');
		
		//delete image entries
		$this->db->where(array('product_sku' => $product_sku));
		$this->db->delete('product_media');

		//delete images from folder
		foreach($product_images as $img)
		{
			if (file_exists($img)) unlink($img);
		}
			
		//need to implement error handling, for now just return true
		return TRUE;
	}

	public function getImages($product_sku)
	{
		$q = $this->db->get_where('product_media', array('product_sku' => $product_sku));

		foreach($q->result() as $row)
		{
			$data[] = $row->image_path;
		}
	
		return $data;
	}

	public function getSKU($id)
	{
		$q = $this->db->get_where('product', array('id' => $id));

		if($q->num_rows() == 1)
		{	
			$row = $q->row();

			$data = $row->product_sku;
			return $data;
		}

		return FALSE;
	}
}
