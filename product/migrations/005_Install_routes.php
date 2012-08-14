<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_routes extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`original_url` VARCHAR(150) NOT NULL");
			$this->dbforge->add_field("`rewrite_url` VARCHAR(250) NOT NULL");
			$this->dbforge->add_field("`category_id` INT(11) NULL DEFAULT 'NULL'");
			$this->dbforge->add_field("`product_id` INT(11) NULL DEFAULT 'NULL'");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('routes');
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('routes');

	}
	
	//--------------------------------------------------------------------
	
}