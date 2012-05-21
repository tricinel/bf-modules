<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_order extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`order_grand_total` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`order_subtotal_shipping` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`order_discount_applied` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`order_status` ENUM('pending','completed','canceled') NOT NULL");
			$this->dbforge->add_field("`order_comment` VARCHAR(1500) NOT NULL");
			$this->dbforge->add_field("`order_customer_id` INT(11) NOT NULL");
			$this->dbforge->add_field("`order_customer_first_name` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`order_customer_last_name` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`order_customer_email` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`order_customer_phone` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`order_customer_billing_address` VARCHAR(1000) NOT NULL");
			$this->dbforge->add_field("`order_customer_shipping_address` VARCHAR(1000) NOT NULL");
			$this->dbforge->add_field("`order_customer_comment` VARCHAR(1500) NOT NULL");
			$this->dbforge->add_field("`order_is_guest` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
			$this->dbforge->add_field("`modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('order');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('order');

	}
	
	//--------------------------------------------------------------------
	
}