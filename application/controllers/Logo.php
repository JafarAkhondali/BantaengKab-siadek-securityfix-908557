<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Logo Controller
*| --------------------------------------------------------------------------
*| Logo site
*|
*/
class Logo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_logo');
	}

	/**
	* show all Logos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('logo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logos'] = $this->model_logo->get($filter, $field, $this->limit_page, $offset);
		$this->data['logo_counts'] = $this->model_logo->count_all($filter, $field);

		$config = [
			'base_url'     => 'logo/index/',
			'total_rows'   => $this->model_logo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Logo List');
		$this->render('modul/logo/logo_list', $this->data);
	}
	
	/**
	* Add new logos
	*
	*/
	public function add()
	{
		$this->is_allowed('logo_add');

		$this->template->title('Logo New');
		$this->render('modul/logo/logo_add', $this->data);
	}

	/**
	* Add New Logos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('logo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('logo_image_name', 'Image', 'trim|required');
		

		if ($this->form_validation->run()) {
			$logo_image_uuid = $this->input->post('logo_image_uuid');
			$logo_image_name = $this->input->post('logo_image_name');
		
			$save_data = [
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'link' => $this->input->post('link'),
				'nama' => $this->input->post('nama'),
			];

			if (!is_dir(FCPATH . '/uploads/logo/')) {
				mkdir(FCPATH . '/uploads/logo/');
			}

			if (!empty($logo_image_name)) {
				$logo_image_name_copy = date('YmdHis') . '-' . $logo_image_name;

				rename(FCPATH . 'uploads/tmp/' . $logo_image_uuid . '/' . $logo_image_name, 
						FCPATH . 'uploads/logo/' . $logo_image_name_copy);

				if (!is_file(FCPATH . '/uploads/logo/' . $logo_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['image'] = $logo_image_name_copy;
			}
		
			
			$save_logo = $this->model_logo->store($save_data);

			if ($save_logo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_logo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('logo/edit/' . $save_logo, 'Edit Logo'),
						anchor('logo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('logo/edit/' . $save_logo, 'Edit Logo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('logo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('logo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Logos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('logo_update');

		$this->data['logo'] = $this->model_logo->find($id);

		$this->template->title('Logo Update');
		$this->render('modul/logo/logo_update', $this->data);
	}

	/**
	* Update Logos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('logo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('logo_image_name', 'Image', 'trim|required');
		
		if ($this->form_validation->run()) {
			$logo_image_uuid = $this->input->post('logo_image_uuid');
			$logo_image_name = $this->input->post('logo_image_name');
		
			$save_data = [
				'link' => $this->input->post('link'),
				'nama' => $this->input->post('nama'),
			];

			if (!is_dir(FCPATH . '/uploads/logo/')) {
				mkdir(FCPATH . '/uploads/logo/');
			}

			if (!empty($logo_image_uuid)) {
				$logo_image_name_copy = date('YmdHis') . '-' . $logo_image_name;

				rename(FCPATH . 'uploads/tmp/' . $logo_image_uuid . '/' . $logo_image_name, 
						FCPATH . 'uploads/logo/' . $logo_image_name_copy);

				if (!is_file(FCPATH . '/uploads/logo/' . $logo_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['image'] = $logo_image_name_copy;
			}
		
			
			$save_logo = $this->model_logo->change($id, $save_data);

			if ($save_logo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('logo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('logo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('logo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Logos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('logo_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'logo'), 'success');
        } else {
            set_message(cclang('error_delete', 'logo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Logos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('logo_view');

		$this->data['logo'] = $this->model_logo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Logo Detail');
		$this->render('modul/logo/logo_view', $this->data);
	}
	
	/**
	* delete Logos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$logo = $this->model_logo->find($id);

		if (!empty($logo->image)) {
			$path = FCPATH . '/uploads/logo/' . $logo->image;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_logo->remove($id);
	}
	
	/**
	* Upload Image Logo	* 
	* @return JSON
	*/
	public function upload_image_file()
	{
		if (!$this->is_allowed('logo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'logo',
		]);
	}

	/**
	* Delete Image Logo	* 
	* @return JSON
	*/
	public function delete_image_file($uuid)
	{
		if (!$this->is_allowed('logo_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'logo',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/logo/'
        ]);
	}

	/**
	* Get Image Logo	* 
	* @return JSON
	*/
	public function get_image_file($id)
	{
		if (!$this->is_allowed('logo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$logo = $this->model_logo->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'image', 
            'table_name'        => 'logo',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/logo/',
            'delete_endpoint'   => 'logo/delete_image_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('logo_export');

		$this->model_logo->export('logo', 'logo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('logo_export');

		$this->model_logo->pdf('logo', 'logo');
	}
}


/* End of file logo.php */
/* Location: ./application/controllers/Logo.php */