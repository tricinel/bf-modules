<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('category_model', null, true);
		$this->lang->load('category');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->category_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}