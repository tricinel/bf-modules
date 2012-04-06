<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Update_media_gallery extends Migration {

	//adds an image label field
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'image_label' => array('type' => 'VARCHAR(128) NULL')
		);

		$this->dbforge->add_column('product_media', $fields);
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_column('product_media', 'image_label');

	}
	
	//--------------------------------------------------------------------
	
}