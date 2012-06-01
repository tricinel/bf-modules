<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Category.Content.View');
		$this->load->model('category_model', null, true);
		$this->lang->load('category');
		
		Template::set_block('sub_nav', 'content/_sub_nav');
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
						$result = $this->category_model->delete($pid);
					}

					if ($result)
					{
						Template::set_message(count($checked) .' '. lang('category_delete_success'), 'success');
					}
					else
					{
						Template::set_message(lang('category_delete_failure') . $this->category_model->error, 'error');
					}
				}
				else
				{
					Template::set_message(lang('category_delete_error') . $this->category_model->error, 'error');
				}
			}
		}

		$records = $this->category_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Category');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Category object.
	*/
	public function create()
	{
		$this->auth->restrict('Category.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_category())
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('category_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/category');
			}
			else
			{
				Template::set_message(lang('category_create_failure') . $this->category_model->error, 'error');
			}
		}
		Assets::add_module_js('category', 'category.js');

		$categories = $this->category_model->find_all();

		Template::set('toolbar_title', lang('category_create') . ' Category');
		Template::set('categories', $categories);
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Category data.
	*/
	public function edit()
	{
		$this->auth->restrict('Category.Content.Edit');

		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('category_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/category');
		}

		if ($this->input->post('submit'))
		{
			if ($this->save_category('update', $id))
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('category_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('category_edit_failure') . $this->category_model->error, 'error');
			}
		}

		Template::set('category', $this->category_model->find($id));
		Assets::add_module_js('category', 'category.js');

		$categories = $this->category_model->find_all();

		Template::set('toolbar_title', lang('category_edit') . ' Category');
		Template::set('categories', $categories);
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: delete()

		Allows deleting of Category data.
	*/
	public function delete()
	{
		$this->auth->restrict('Category.Content.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{

			if ($this->category_model->delete($id))
			{
				// Log the activity
				$this->load->model('activities/Activity_model', 'activity_model');

				$this->activity_model->log_activity($this->current_user->id, lang('category_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('category_delete_failure') . $this->category_model->error, 'error');
			}
		}

		redirect(SITE_AREA .'/content/category');
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_category()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_category($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('category_name','Category name','required|trim|xss_clean|max_length[128]');
		$this->form_validation->set_rules('category_is_active','Category is active','required|integer|max_length[1]');
		$this->form_validation->set_rules('category_parent_id','Category parent ID','integer|max_length[11]');
		$this->form_validation->set_rules('category_meta_title','Category meta title','trim|xss_clean|max_length[250]');
		$this->form_validation->set_rules('category_meta_description','Category meta description','trim|xss_clean');
		$this->form_validation->set_rules('category_meta_keywords','Category meta keywords','trim|xss_clean');
		$this->form_validation->set_rules('category_url','Category URL','unique[bcz_category.category_url,bcz_category.id]|trim|xss_clean|max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		$url                               = $this->input->post('category_url');
		$category_name                     = $this->input->post('category_name');
		$category_meta_title               = $this->input->post('category_meta_title');
		$category_products_count           = $this->input->post('category_products_count');
		
		$data                              = array();
		$data['category_name']             = $category_name;
		$data['category_is_active']        = $this->input->post('category_is_active');
		$data['category_parent_id']        = $this->input->post('category_parent_id');
		$data['category_meta_title']       = (empty($category_meta_title)) ? $category_name : $category_meta_title;
		$data['category_meta_description'] = $this->input->post('category_meta_description');
		$data['category_meta_keywords']    = $this->input->post('category_meta_keywords');
		$data['category_url']              = (empty($url)) ? $this->sanitize_segment($category_name) : $this->sanitize_segment($url);

		if ($type == 'insert')
		{
			$id = $this->category_model->insert($data);

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
			$return = $this->category_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------

	/*
		Method: sanitize_segment($segment)
		
		Creates a web-friendly version of a string by eliminating spaces and other characters
		
		Parameters:
			$segment	- the string to be sanitized
		
		Returns:
			A web-friendly string
	*/

	private function sanitize_segment($segment)
	{
		$chars = array(' ', '/', '&', '"', '(', ')', '#', ',', '.','----','---','--','\'');
	    foreach($chars as $char){
	       $segment = str_replace($char, "-", $segment);
	    }
    	return strtolower($segment);
	}

	//--------------------------------------------------------------------

}