<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_coupon extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`coupon_code` VARCHAR(128) NOT NULL");
			$this->dbforge->add_field("`coupon_discount_type` ENUM('percentage of total','fixed') NOT NULL");
			$this->dbforge->add_field("`coupon_discount_amount` DECIMAL(12,4) NOT NULL");
			$this->dbforge->add_field("`coupon_uses_limit` INT(11) NULL");
			$this->dbforge->add_field("`coupon_uses_per_customer` INT(11) NULL");
			$this->dbforge->add_field("`coupon_allowed_for_guests` TINYINT(1) NOT NULL");
			$this->dbforge->add_field("`coupon_expiration_date` DATETIME NULL");
			$this->dbforge->add_field("`coupon_times_used` INT(11) NOT NULL DEFAULT '0'");
			$this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('coupon');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('coupon');

	}
	
	//--------------------------------------------------------------------
	
}