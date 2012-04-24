<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Coupon.Reports.View');
		$this->load->model('coupon_model', null, true);
		$this->lang->load('coupon');
		
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_css('jquery-ui-timepicker.css');
		Assets::add_js('jquery-ui-timepicker-addon.js');
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->coupon_model->find_all());
		Template::set('toolbar_title', "Manage Coupon");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a Coupon object.
	*/
	public function create() 
	{
		$this->auth->restrict('Coupon.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_coupon())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('coupon_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'coupon');
					
				Template::set_message(lang("coupon_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/coupon');
			}
			else 
			{
				Template::set_message(lang('coupon_create_failure') . $this->coupon_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('coupon_create_new_button'));
		Template::set('toolbar_title', lang('coupon_create') . ' Coupon');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of Coupon data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Coupon.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('coupon_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/coupon');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_coupon('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('coupon_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'coupon');
					
				Template::set_message(lang('coupon_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('coupon_edit_failure') . $this->coupon_model->error, 'error');
			}
		}
		
		Template::set('coupon', $this->coupon_model->find($id));
	
		Template::set('toolbar_title', lang('coupon_edit_heading'));
		Template::set('toolbar_title', lang('coupon_edit') . ' Coupon');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of Coupon data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Coupon.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->coupon_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('coupon_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'coupon');
					
				Template::set_message(lang('coupon_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('coupon_delete_failure') . $this->coupon_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/coupon');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_coupon()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_coupon($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('coupon_code','Coupon code','required|unique[bf_coupon.coupon_code,bf_coupon.id]|trim|xss_clean|max_length[128]');			
		$this->form_validation->set_rules('coupon_discount_type','Discount type','required|trim|xss_clean');			
		$this->form_validation->set_rules('coupon_discount_amount','Discount amount','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('coupon_uses_limit','Limit uses to','trim|xss_clean|integer|max_length[11]');			
		$this->form_validation->set_rules('coupon_uses_per_customer','Limit customer uses to','trim|xss_clean|max_length[11]');			
		$this->form_validation->set_rules('coupon_allowed_for_guests','Allow guests to use coupon','required|trim|xss_clean|max_length[1]');			
		$this->form_validation->set_rules('coupon_expiration_date','Valid until','trim|xss_clean');			
		$this->form_validation->set_rules('coupon_times_used','Times used','trim|xss_clean|max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['coupon_code']        = $this->input->post('coupon_code');
		$data['coupon_discount_type']        = $this->input->post('coupon_discount_type');
		$data['coupon_discount_amount']        = $this->input->post('coupon_discount_amount');
		$data['coupon_uses_limit']        = $this->input->post('coupon_uses_limit');
		$data['coupon_uses_per_customer']        = $this->input->post('coupon_uses_per_customer');
		$data['coupon_allowed_for_guests']        = $this->input->post('coupon_allowed_for_guests');
		$data['coupon_expiration_date']        = $this->input->post('coupon_expiration_date');
		$data['coupon_times_used']        = $this->input->post('coupon_times_used');
		
		if ($type == 'insert')
		{
			$id = $this->coupon_model->insert($data);
			
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
			$return = $this->coupon_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}