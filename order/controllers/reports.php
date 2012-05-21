<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Order.Reports.View');
		$this->load->model('order_model', null, true);
		$this->lang->load('order');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->order_model->find_all());
		Template::set('toolbar_title', "Manage Order");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a Order object.
	*/
	public function create() 
	{
		$this->auth->restrict('Order.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_order())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'order');
					
				Template::set_message(lang("order_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/order');
			}
			else 
			{
				Template::set_message(lang('order_create_failure') . $this->order_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('order_create_new_button'));
		Template::set('toolbar_title', lang('order_create') . ' Order');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of Order data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Order.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('order_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/order');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_order('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');
					
				Template::set_message(lang('order_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('order_edit_failure') . $this->order_model->error, 'error');
			}
		}
		
		Template::set('order', $this->order_model->find($id));
	
		Template::set('toolbar_title', lang('order_edit_heading'));
		Template::set('toolbar_title', lang('order_edit') . ' Order');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of Order data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Order.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->order_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');
					
				Template::set_message(lang('order_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('order_delete_failure') . $this->order_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/order');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_order()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_order($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('order_grand_total','Grand total','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('order_subtotal_shipping','Shipping cost','required|trim|xss_clean|is_decimal|max_length[13]');			
		$this->form_validation->set_rules('order_discount_applied','Discount applied','max_length[13]');			
		$this->form_validation->set_rules('order_status','Status','required|trim|xss_clean');			
		$this->form_validation->set_rules('order_comment','Sales comments','trim|xss_clean|max_length[1500]');			
		$this->form_validation->set_rules('order_customer_id','Customer ID','required|trim|xss_clean|integer|max_length[11]');			
		$this->form_validation->set_rules('order_customer_first_name','First name','required|trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('order_customer_last_name','Last name','required|trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('order_customer_email','Email','required|valid_email|max_length[255]');			
		$this->form_validation->set_rules('order_customer_phone','Phone','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('order_customer_billing_address','Billing Address','required|trim|xss_clean|max_length[1000]');			
		$this->form_validation->set_rules('order_customer_shipping_address','Shipping Address','required|trim|xss_clean|max_length[1000]');			
		$this->form_validation->set_rules('order_customer_comment','Customer comments','trim|xss_clean|max_length[1500]');			
		$this->form_validation->set_rules('order_is_guest','Is guest','required|integer|max_length[1]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['order_grand_total']        = $this->input->post('order_grand_total');
		$data['order_subtotal_shipping']        = $this->input->post('order_subtotal_shipping');
		$data['order_discount_applied']        = $this->input->post('order_discount_applied');
		$data['order_status']        = $this->input->post('order_status');
		$data['order_comment']        = $this->input->post('order_comment');
		$data['order_customer_id']        = $this->input->post('order_customer_id');
		$data['order_customer_first_name']        = $this->input->post('order_customer_first_name');
		$data['order_customer_last_name']        = $this->input->post('order_customer_last_name');
		$data['order_customer_email']        = $this->input->post('order_customer_email');
		$data['order_customer_phone']        = $this->input->post('order_customer_phone');
		$data['order_customer_billing_address']        = $this->input->post('order_customer_billing_address');
		$data['order_customer_shipping_address']        = $this->input->post('order_customer_shipping_address');
		$data['order_customer_comment']        = $this->input->post('order_customer_comment');
		$data['order_is_guest']        = $this->input->post('order_is_guest');
		
		if ($type == 'insert')
		{
			$id = $this->order_model->insert($data);
			
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
			$return = $this->order_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}