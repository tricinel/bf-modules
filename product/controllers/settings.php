<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Product.Settings.View');
		$this->load->model('product_model', null, true);
		$this->lang->load('product');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_css('jquery-ui-timepicker.css');
			Assets::add_js('jquery-ui-timepicker-addon.js');
			Assets::add_js(Template::theme_url('js/editors/ckeditor/ckeditor.js'));
		Template::set_block('sub_nav', 'settings/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		// Deleting anything?
		if ($action = $this->input->post('delete'))
		{
			if ($action == 'Delete')
			{
				$checked = $this->input->post('checked');

				if (is_array($checked) && count($checked))
				{
					$result = FALSE;
					foreach ($checked as $pid)
					{
						$result = $this->product_model->delete($pid);
					}

					if ($result)
					{
						Template::set_message(count($checked) .' '. lang('product_delete_success'), 'success');
					}
					else
					{
						Template::set_message(lang('product_delete_failure') . $this->product_model->error, 'error');
					}
				}
				else
				{
					Template::set_message(lang('product_delete_error') . $this->product_model->error, 'error');
				}
			}
		}

		$records = $this->product_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Product');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Product object.
	*/
	public function create()
	{
		$this->auth->restrict('Product.Settings.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_product())
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('product_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'product');

				Template::set_message(lang('product_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/product');
			}
			else
			{
				Template::set_message(lang('product_create_failure') . $this->product_model->error, 'error');
			}
		}
		Assets::add_module_js('product', 'product.js');

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
		$this->auth->restrict('Product.Settings.Edit');

		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('product_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/product');
		}

		if ($this->input->post('submit'))
		{
			if ($this->save_product('update', $id))
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('product_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'product');

				Template::set_message(lang('product_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('product_edit_failure') . $this->product_model->error, 'error');
			}
		}

		Template::set('product', $this->product_model->find($id));
		Assets::add_module_js('product', 'product.js');

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
		$this->auth->restrict('Product.Settings.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{

			if ($this->product_model->delete($id))
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('product_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'product');

				Template::set_message(lang('product_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('product_delete_failure') . $this->product_model->error, 'error');
			}
		}

		redirect(SITE_AREA .'/settings/product');
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
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('product_sku','Product Sku','required|unique[bcz_product.product_sku,bcz_product.id]|trim|xss_clean|max_length[64]');
		$this->form_validation->set_rules('product_price','Product Price','required|trim|xss_clean|is_decimal|max_length[13]');
		$this->form_validation->set_rules('product_special_price','Product Special Price','is_decimal|max_length[13]');
		$this->form_validation->set_rules('product_special_price_from_date','Product Special Price From Date','');
		$this->form_validation->set_rules('product_special_price_to_date','Product Special Price To Date','');
		$this->form_validation->set_rules('product_cost','Product Cost','required|trim|xss_clean|is_decimal|max_length[13]');
		$this->form_validation->set_rules('product_name','Product Name','required|trim|xss_clean|max_length[250]');
		$this->form_validation->set_rules('product_description','Product Description','required|trim|xss_clean');
		$this->form_validation->set_rules('product_meta_title','Product Meta Title','trim|xss_clean|max_length[250]');
		$this->form_validation->set_rules('product_meta_description','Product Meta Description','trim|xss_clean');
		$this->form_validation->set_rules('product_meta_keywords','Product Meta Keywords','trim|xss_clean');
		$this->form_validation->set_rules('product_is_new','Product Is New','required|integer|max_length[1]');
		$this->form_validation->set_rules('product_is_active','Product Is Active','required|integer|max_length[1]');
		$this->form_validation->set_rules('product_weight','Product Weight','required|trim|xss_clean|is_decimal|max_length[13]');
		$this->form_validation->set_rules('product_url','Product Url','unique[bcz_product.product_url,bcz_product.id]|trim|xss_clean|max_length[255]');

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