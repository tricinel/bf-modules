<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Product.Reports.View');
		$this->load->model('product_model', null, true);
		$this->lang->load('product');
		
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_css('jquery-ui-timepicker.css');
		Assets::add_js('jquery-ui-timepicker-addon.js');
		Assets::add_js(Template::theme_url('js/editors/ckeditor/ckeditor.js'));
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->product_model->find_all());
		Template::set('toolbar_title', "Manage Product");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a Product object.
	*/
	public function create() 
	{
		$this->auth->restrict('Product.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_product())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('product_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'product');
					
				Template::set_message(lang("product_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/product');
			}
			else 
			{
				Template::set_message(lang('product_create_failure') . $this->product_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('product_create_new_button'));
		Template::set('toolbar_title', lang('product_create') . ' Product');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of Product data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Product.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('product_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/product');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_product('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('product_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'product');
					
				Template::set_message(lang('product_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('product_edit_failure') . $this->product_model->error, 'error');
			}
		}
		
		Template::set('product', $this->product_model->find($id));
	
		Template::set('toolbar_title', lang('product_edit_heading'));
		Template::set('toolbar_title', lang('product_edit') . ' Product');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of Product data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Product.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->product_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('product_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'product');
					
				Template::set_message(lang('product_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('product_delete_failure') . $this->product_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/product');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_product()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_product($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('product_sku','SKU','required|unique[bf_product.product_sku,bf_product.id]|trim|xss_clean|max_length[64]');			
		$this->form_validation->set_rules('product_price','Price','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('product_special_price','Special Price','trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('product_special_price_from_date','Special Price From Date','trim|xss_clean');			
		$this->form_validation->set_rules('product_special_price_to_date','Special Price To Date','trim|xss_clean');			
		$this->form_validation->set_rules('product_cost','Cost','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('product_name','Name','required|trim|xss_clean|max_length[250]');			
		$this->form_validation->set_rules('product_description','Description','required|trim|xss_clean|max_length[2500]');			
		$this->form_validation->set_rules('product_meta_title','Meta title','trim|xss_clean|max_length[250]');			
		$this->form_validation->set_rules('product_meta_description','Meta description','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('product_meta_keywords','Meta keywords','trim|xss_clean|max_length[1500]');			
		$this->form_validation->set_rules('product_is_new','Is new','trim|xss_clean|integer|max_length[1]');			
		$this->form_validation->set_rules('product_is_active','Visibility','trim|xss_clean|integer|max_length[1]');			
		$this->form_validation->set_rules('product_weight','Weight','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('product_url','URL','unique[bf_product.product_url,bf_product.id]|trim|xss_clean|max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['product_sku']        = $this->input->post('product_sku');
		$data['product_price']        = $this->input->post('product_price');
		$data['product_special_price']        = $this->input->post('product_special_price');
		$data['product_special_price_from_date']        = $this->input->post('product_special_price_from_date');
		$data['product_special_price_to_date']        = $this->input->post('product_special_price_to_date');
		$data['product_cost']        = $this->input->post('product_cost');
		$data['product_name']        = $this->input->post('product_name');
		$data['product_description']        = $this->input->post('product_description');
		$data['product_meta_title']        = $this->input->post('product_meta_title');
		$data['product_meta_description']        = $this->input->post('product_meta_description');
		$data['product_meta_keywords']        = $this->input->post('product_meta_keywords');
		$data['product_is_new']        = $this->input->post('product_is_new');
		$data['product_is_active']        = $this->input->post('product_is_active');
		$data['product_weight']        = $this->input->post('product_weight');
		$data['product_url']        = $this->input->post('product_url');
		
		if ($type == 'insert')
		{
			$id = $this->product_model->insert($data);
			
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->product_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}