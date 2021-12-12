<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Ktp Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Ktp site
*|
*/
class Tbl_korduk_ktp extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_ktp');
	}

	/**
	* show all Tbl Korduk Ktps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_ktp_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_ktps'] = $this->model_tbl_korduk_ktp->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_ktp_counts'] = $this->model_tbl_korduk_ktp->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_ktp/index/',
			'total_rows'   => $this->model_tbl_korduk_ktp->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk KTP List');
		$this->render('modul/tbl_korduk_ktp/tbl_korduk_ktp_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_ktps
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_ktp_add');

		$this->template->title('Adminduk KTP New');
		$this->render('modul/tbl_korduk_ktp/tbl_korduk_ktp_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Ktps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_ktp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_korduk_ktp_form_name', 'Form F-1.01', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_ktp_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_ktp_suket_hilang_name', 'Suket Hilang', 'trim');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_ktp_form_uuid = $this->input->post('tbl_korduk_ktp_form_uuid');
			$tbl_korduk_ktp_form_name = $this->input->post('tbl_korduk_ktp_form_name');
			$tbl_korduk_ktp_kk_uuid = $this->input->post('tbl_korduk_ktp_kk_uuid');
			$tbl_korduk_ktp_kk_name = $this->input->post('tbl_korduk_ktp_kk_name');
			$tbl_korduk_ktp_suket_hilang_uuid = $this->input->post('tbl_korduk_ktp_suket_hilang_uuid');
			$tbl_korduk_ktp_suket_hilang_name = $this->input->post('tbl_korduk_ktp_suket_hilang_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_ktp/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_ktp/');
			}

			if (!empty($tbl_korduk_ktp_form_name)) {
				$tbl_korduk_ktp_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_form_uuid . '/' . $tbl_korduk_ktp_form_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_ktp_form_name_copy;
			}
		
			if (!empty($tbl_korduk_ktp_kk_name)) {
				$tbl_korduk_ktp_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_kk_uuid . '/' . $tbl_korduk_ktp_kk_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_ktp_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_ktp_suket_hilang_name)) {
				$tbl_korduk_ktp_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_suket_hilang_uuid . '/' . $tbl_korduk_ktp_suket_hilang_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_korduk_ktp_suket_hilang_name_copy;
			}
		
			
			$save_tbl_korduk_ktp = $this->model_tbl_korduk_ktp->store($save_data);

			if ($save_tbl_korduk_ktp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_ktp;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_ktp/edit/' . $save_tbl_korduk_ktp, 'Edit Tbl Korduk Ktp'),
						anchor('tbl_korduk_ktp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_ktp/edit/' . $save_tbl_korduk_ktp, 'Edit Tbl Korduk Ktp')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_ktp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_ktp');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Ktps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_ktp_update');

		$this->data['tbl_korduk_ktp'] = $this->model_tbl_korduk_ktp->find($id);

		$this->template->title('Adminduk KTP Update');
		$this->render('modul/tbl_korduk_ktp/tbl_korduk_ktp_update', $this->data);
	}

	/**
	* Update Tbl Korduk Ktps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_korduk_ktp_form_name', 'Form F-1.01', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_ktp_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_ktp_suket_hilang_name', 'Suket Hilang', 'trim');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_ktp_form_uuid = $this->input->post('tbl_korduk_ktp_form_uuid');
			$tbl_korduk_ktp_form_name = $this->input->post('tbl_korduk_ktp_form_name');
			$tbl_korduk_ktp_kk_uuid = $this->input->post('tbl_korduk_ktp_kk_uuid');
			$tbl_korduk_ktp_kk_name = $this->input->post('tbl_korduk_ktp_kk_name');
			$tbl_korduk_ktp_suket_hilang_uuid = $this->input->post('tbl_korduk_ktp_suket_hilang_uuid');
			$tbl_korduk_ktp_suket_hilang_name = $this->input->post('tbl_korduk_ktp_suket_hilang_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_ktp/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_ktp/');
			}

			if (!empty($tbl_korduk_ktp_form_uuid)) {
				$tbl_korduk_ktp_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_form_uuid . '/' . $tbl_korduk_ktp_form_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_ktp_form_name_copy;
			}
		
			if (!empty($tbl_korduk_ktp_kk_uuid)) {
				$tbl_korduk_ktp_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_kk_uuid . '/' . $tbl_korduk_ktp_kk_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_ktp_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_ktp_suket_hilang_uuid)) {
				$tbl_korduk_ktp_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_korduk_ktp_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_ktp_suket_hilang_uuid . '/' . $tbl_korduk_ktp_suket_hilang_name, 
						FCPATH . 'uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_korduk_ktp_suket_hilang_name_copy;
			}
		
			
			$save_tbl_korduk_ktp = $this->model_tbl_korduk_ktp->change($id, $save_data);

			if ($save_tbl_korduk_ktp) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_ktp', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_ktp');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_ktp');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Ktps
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_ktp_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_ktp'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_ktp'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Ktps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_ktp_view');

		$this->data['tbl_korduk_ktp'] = $this->model_tbl_korduk_ktp->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk KTP Detail');
		$this->render('modul/tbl_korduk_ktp/tbl_korduk_ktp_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Ktps
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_ktp = $this->model_tbl_korduk_ktp->find($id);

		if (!empty($tbl_korduk_ktp->form)) {
			$path = FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp->form;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_ktp->kk)) {
			$path = FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_ktp->suket_hilang)) {
			$path = FCPATH . '/uploads/tbl_korduk_ktp/' . $tbl_korduk_ktp->suket_hilang;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_ktp->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function upload_form_file()
	{
		if (!$this->is_allowed('tbl_korduk_ktp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_ktp',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function delete_form_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'form', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function get_form_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_ktp = $this->model_tbl_korduk_ktp->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form', 
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/',
            'delete_endpoint'   => 'tbl_korduk_ktp/delete_form_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_korduk_ktp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_ktp',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'kk', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_ktp = $this->model_tbl_korduk_ktp->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/',
            'delete_endpoint'   => 'tbl_korduk_ktp/delete_kk_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function upload_suket_hilang_file()
	{
		if (!$this->is_allowed('tbl_korduk_ktp_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_ktp',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function delete_suket_hilang_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'suket_hilang', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Ktp	* 
	* @return JSON
	*/
	public function get_suket_hilang_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_ktp_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_ktp = $this->model_tbl_korduk_ktp->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_hilang', 
            'table_name'        => 'tbl_korduk_ktp',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_ktp/',
            'delete_endpoint'   => 'tbl_korduk_ktp/delete_suket_hilang_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_ktp_export');

		$this->model_tbl_korduk_ktp->export('tbl_korduk_ktp', 'tbl_korduk_ktp');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_ktp_export');

		$this->model_tbl_korduk_ktp->pdf('tbl_korduk_ktp', 'tbl_korduk_ktp');
	}
}


/* End of file tbl_korduk_ktp.php */
/* Location: ./application/controllers/Tbl Korduk Ktp.php */