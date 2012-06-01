<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_category extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`category_name` VARCHAR(128) NOT NULL");
			$this->dbforge->add_field("`category_is_active` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`category_parent_id` INT(11) NULL");
			$this->dbforge->add_field("`category_products_count` INT(11) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`category_meta_title` VARCHAR(250) NOT NULL");
			$this->dbforge->add_field("`category_meta_description` TEXT NULL");
			$this->dbforge->add_field("`category_meta_keywords` TEXT NULL");
			$this->dbforge->add_field("`category_url` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('category');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('category');

	}
	
	//--------------------------------------------------------------------
	
}