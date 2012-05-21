<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_ordered_products extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`order_id` INT(11) NOT NULL");
			$this->dbforge->add_field("`product_sku` VARCHAR(64) NOT NULL");
			$this->dbforge->add_field("`product_price` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`product_amount_ordered` INT(11) NOT NULL");
			$this->dbforge->add_field("`product_weight` DECIMAL(12,4) NOT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('ordered_products');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('ordered_products');

	}
	
	//--------------------------------------------------------------------
	
}