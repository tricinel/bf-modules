<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Routes_model extends BF_Model {

	protected $table		= "routes";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;

	// --------------------------------------------------------------------------

    /**
     * Sync routes
     *
     * @access	public
     * @return 	bool
     */
    public function sync_routes()
    {
    	$this->load->helper('file');


    	$routes_file = APPPATH.'config/routes.php';//this is the original routes file
    	$backup_path = APPPATH.'db/backups/routes';//this is the path where to save all the backups and a copy of the default routes
    	$default_routes_file = $backup_path . '/default_routes.php';//this is the default routes file
    	$routes_backup_file = $backup_path . '/routes_' . date('d_m_Y') . '_' . rand(1000000,9999999);//this is the backup file

    	//if the backup dir is not there, create it - should only run once
    	if(!is_dir($backup_path)) mkdir($backup_path, 0700);

    	$routes_file_info = get_file_info($routes_file, 'writable');
    	$default_routes_file_info = file_exists($default_routes_file);

    	// Check to make sure that we can read/write the routes.php file
    	$routes_file_info = get_file_info($routes_file, 'writable');
		// Does it even exist? Is it writable?
		if(!$routes_file_info or !$routes_file_info['writable']) return false;

		// Check to see if the default_routes.php file is there
		if(!$default_routes_file_info) :
			//the file is not there, let's create it
			//first read the contents of the original routes file
			$r = read_file($routes_file)."\n";
			$handle = fopen($default_routes_file, 'w') or die('Cannot open file:  '.$default_routes_file);
			fwrite($handle, $r);
		else :
			//the file is there, so make the $routes_file equal to it
			$r = read_file($default_routes_file)."\n";
		endif;

		/*
			Create a backup of the old routes file, date it and append a unique code to it
		*/

		// Let's start our routes file!
		$b = read_file($routes_file)."\n";
		$handle = fopen($routes_backup_file, 'w') or die('Cannot open file:  '.$routes_backup_file);
		fwrite($handle, $b);

		/*
			Write to the actual routes file
		*/

		// Get the routes
		$routes = $this->select('original_url, rewrite_url')->find_all();

		if($routes):
			$r .= "\n/* Custom Routes from DB */\n\n";

			foreach($routes as $route):
				$r .= "\$route['{$route->original_url}'] = '{$route->rewrite_url}';\n";
			endforeach;

		endif;

		$r .= "\n".'/* End of file routes.php */';
		// Clear the file first
		file_put_contents($routes_file, '');
		// Write the file
		return write_file($routes_file, $r, 'r+');
	}

}