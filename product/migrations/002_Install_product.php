<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_product extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`product_sku` VARCHAR(64) NOT NULL");
			$this->dbforge->add_field("`product_price` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`product_special_price` DECIMAL(12,4) NULL");
			$this->dbforge->add_field("`product_special_price_from_date` DATETIME NULL");
			$this->dbforge->add_field("`product_special_price_to_date` DATETIME NULL");
			$this->dbforge->add_field("`product_cost` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`product_name` VARCHAR(250) NOT NULL");
			$this->dbforge->add_field("`product_description` TEXT NOT NULL");
			$this->dbforge->add_field("`product_meta_title` VARCHAR(250) NOT NULL");
			$this->dbforge->add_field("`product_meta_description` TEXT NULL");
			$this->dbforge->add_field("`product_meta_keywords` TEXT NULL");
			$this->dbforge->add_field("`product_is_new` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`product_is_active` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`product_weight` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`product_url` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('product');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('product');

	}
	
	//--------------------------------------------------------------------
	
}