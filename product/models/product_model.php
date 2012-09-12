<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends BF_Model {

	protected $table		= "product";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_on";


	//---------------------------------------------------------------

	/*
		Method: insertStockData()

		Inserts a row of data into the database.

		Extends:
			MY_Model insert($data)
			Used as more of a convenience method to insert data into a table

		Parameters:
			$stock	- an array of key/value pairs to insert.

		Return:
			Either the $id of the row inserted, or FALSE on failure.
	*/
	public function insertStockData($stock)
	{
		$this->table = 'product_stock';
		$this->set_created = false;
		return parent::insert($stock);
	}


	//---------------------------------------------------------------

	/*
		Method: insertImageData()

		Inserts row(s) of data into the database using a batch insert

		Parameters:
			$images	- an array or arrays of key/value pairs to insert.

		Return:
			Either the number of inserted rows, or FALSE on failure.
	*/
	public function insertImageData($images)
	{
		$status = $this->db->insert_batch('product_media', $images);

		if ($status != FALSE)
		{
			return $this->db->affected_rows();
		} else
		{
			$this->error = mysql_error();
			return FALSE;
		}
	}


	//---------------------------------------------------------------

	/*
		Method: delete()

		Deletes a row from the database.

		Extends:
			MY_Model delete($id)
			Deletes product route, product stock information, product media
			Also sets erros, if any, for each individual delete action

		Parameters:
			$id	- the ID of the row to delete

		Return:
			Either true for success, or FALSE on failure.
	*/
	public function delete($id=NULL)
	{
		//get product additional information :: routes, stock information, product media
		$product_additional = $this->select('id,product_sku,product_category_id')->find($id);
		$result = parent::delete($id);

		if($result && $product_additional) {
			$product_sku = $product_additional->product_sku;
			$product_category_id = $product_additional->product_category_id;

			//delete images from folder
			$img_errors = $this->deleteImages($product_sku);
			if(is_array($img_errors)) $this->error .= implode("<br/>", $img_errors);

			//delete product stock information, image entries
			$this->db->where(array('product_sku' => $product_sku));
			if(!$this->db->delete(array('product_stock', 'product_media'))) $this->error .= "<br/>".mysql_error();
			//delete product route
			$this->db->where(array('product_id' => $id));
			if(!$this->db->delete('routes')) $this->error .= "<br/>".mysql_error();

			//decrease number of products in category
			$this->db->set('category_products_count', 'category_products_count - 1', FALSE)->where('id', $product_category_id);
			if(!$this->db->update('category')) $this->error .= "<br/>".mysql_error();

			if( $this->error == '' ) $result = false;
		}

		return $result;
	}


	//---------------------------------------------------------------

	/*
		Method: getImages()

		Get all the images associated with the product

		Parameters:
			$sku	- string: the product sku to use as reference

		Return:
			Either an array of image objects, or FALSE on failure.
	*/
	public function getImages($sku)
	{
		$q = $this->db->get_where('product_media', array('product_sku' => $sku));

		if($q->num_rows() > 0) {
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}

			return $data;
		}

		return false;
	}


	//---------------------------------------------------------------

	/*
		Method: getStockInformation()

		Get stock information associated with the product

		Parameters:
			$sku	- string: the product sku to use as reference

		Return:
			Either an array, or FALSE on failure.
	*/
	public function getStockInformation($sku)
	{
		$q = $this->db->get_where('product_stock', array('product_sku' => $sku));

		if($q->num_rows() > 0) {
			return $q->row_array();
		}

		return false;
	}


	//---------------------------------------------------------------

	/*
		Method: deleteImages()

		Deletes images from the server

		Parameters:
			$sku	- string: the product sku to use as reference

		Return:
			Either TRUE or an array of errors on failure.
	*/
	private function deleteImages($sku)
	{
		$product_images = $this->getImages($sku);
		$errors = array();
		$catalog_path = 'media/catalog/';

		//delete images from folder
		if($product_images) {
			foreach($product_images as $img)
			{
				if ( !file_exists($catalog_path.$img->image_path) )
					$errors[] = 'Image does not exist!';
				if( !unlink($catalog_path.$img->image_path) ) $errors[] = 'Image could not be deleted!';
			}
		} else {
			$errors[] = 'No images for this product exist!';
		}

		if(count($errors) > 0) return $errors;
		else return true;
	}
}
