<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_media_gallery extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`product_sku` VARCHAR(64) NOT NULL");
			$this->dbforge->add_field("`image_path` VARCHAR(250) NOT NULL");
			$this->dbforge->add_field("`image_position` TINYINT(1) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`image_is_default` TINYINT(1) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`image_is_thumb` TINYINT(1) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`image_is_small_image` TINYINT(1) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`image_label` VARCHAR(128) NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('product_media');
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('product_media');

	}
	
	//--------------------------------------------------------------------
	
}