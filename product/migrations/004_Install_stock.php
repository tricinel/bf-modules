<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_stock extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`product_sku` VARCHAR(64) NOT NULL");
			$this->dbforge->add_field("`qty` INT(11) NULL");
			$this->dbforge->add_field("`low_stock_qty` INT(11) NULL");
			$this->dbforge->add_field("`is_in_stock` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`manage_stock` TINYINT(1) NOT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('product_stock');
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('product_stock');

	}
	
	//--------------------------------------------------------------------
	
}