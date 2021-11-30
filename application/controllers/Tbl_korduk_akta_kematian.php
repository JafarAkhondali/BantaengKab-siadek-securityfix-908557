<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Kematian Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Kematian site
*|
*/
class Tbl_korduk_akta_kematian extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_akta_kematian');
	}

	/**
	* show all Tbl Korduk Akta Kematians
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_akta_kematian_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_akta_kematians'] = $this->model_tbl_korduk_akta_kematian->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_akta_kematian_counts'] = $this->model_tbl_korduk_akta_kematian->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_akta_kematian/index/',
			'total_rows'   => $this->model_tbl_korduk_akta_kematian->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Akta Kematian List');
		$this->render('modul/tbl_korduk_akta_kematian/tbl_korduk_akta_kematian_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_akta_kematians
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_akta_kematian_add');

		$this->template->title('Adminduk Akta Kematian New');
		$this->render('modul/tbl_korduk_akta_kematian/tbl_korduk_akta_kematian_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Akta Kematians
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_add', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_akta_kematian_form_f229_name', 'Form F-2.29', 'trim|required');
	//	$this->form_validation->set_rules('tbl_korduk_akta_kematian_kk_name', 'KK', 'trim|required');
	//	$this->form_validation->set_rules('tbl_korduk_akta_kematian_ktp_name', 'KTP', 'trim|required');
	//	$this->form_validation->set_rules('tbl_korduk_akta_kematian_suket_kematian_name', 'Suket Kematian', 'trim|required');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_akta_kematian_form_f229_uuid = $this->input->post('tbl_korduk_akta_kematian_form_f229_uuid');
			$tbl_korduk_akta_kematian_form_f229_name = $this->input->post('tbl_korduk_akta_kematian_form_f229_name');
			$tbl_korduk_akta_kematian_kk_uuid = $this->input->post('tbl_korduk_akta_kematian_kk_uuid');
			$tbl_korduk_akta_kematian_kk_name = $this->input->post('tbl_korduk_akta_kematian_kk_name');
			$tbl_korduk_akta_kematian_ktp_uuid = $this->input->post('tbl_korduk_akta_kematian_ktp_uuid');
			$tbl_korduk_akta_kematian_ktp_name = $this->input->post('tbl_korduk_akta_kematian_ktp_name');
			$tbl_korduk_akta_kematian_suket_kematian_uuid = $this->input->post('tbl_korduk_akta_kematian_suket_kematian_uuid');
			$tbl_korduk_akta_kematian_suket_kematian_name = $this->input->post('tbl_korduk_akta_kematian_suket_kematian_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_kematian/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_kematian/');
			}

			if (!empty($tbl_korduk_akta_kematian_form_f229_name)) {
				$tbl_korduk_akta_kematian_form_f229_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_form_f229_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_form_f229_uuid . '/' . $tbl_korduk_akta_kematian_form_f229_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_form_f229_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_form_f229_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f229'] = $tbl_korduk_akta_kematian_form_f229_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_kk_name)) {
				$tbl_korduk_akta_kematian_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_kk_uuid . '/' . $tbl_korduk_akta_kematian_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_kematian_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_ktp_name)) {
				$tbl_korduk_akta_kematian_ktp_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_ktp_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_ktp_uuid . '/' . $tbl_korduk_akta_kematian_ktp_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_ktp_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_ktp_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp'] = $tbl_korduk_akta_kematian_ktp_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_suket_kematian_name)) {
				$tbl_korduk_akta_kematian_suket_kematian_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_suket_kematian_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_suket_kematian_uuid . '/' . $tbl_korduk_akta_kematian_suket_kematian_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_suket_kematian_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_suket_kematian_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_kematian'] = $tbl_korduk_akta_kematian_suket_kematian_name_copy;
			}
		
			
			$save_tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->store($save_data);

			if ($save_tbl_korduk_akta_kematian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_akta_kematian;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_akta_kematian/edit/' . $save_tbl_korduk_akta_kematian, 'Edit Tbl Korduk Akta Kematian'),
						anchor('tbl_korduk_akta_kematian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_akta_kematian/edit/' . $save_tbl_korduk_akta_kematian, 'Edit Tbl Korduk Akta Kematian')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_kematian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_kematian');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Akta Kematians
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_akta_kematian_update');

		$this->data['tbl_korduk_akta_kematian'] = $this->model_tbl_korduk_akta_kematian->find($id);

		$this->template->title('Adminduk Akta Kematian Update');
		$this->render('modul/tbl_korduk_akta_kematian/tbl_korduk_akta_kematian_update', $this->data);
	}

	/**
	* Update Tbl Korduk Akta Kematians
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_update', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_akta_kematian_form_f229_name', 'Form F-2.29', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kematian_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kematian_ktp_name', 'KTP', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kematian_suket_kematian_name', 'Suket Kematian', 'trim|required');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_akta_kematian_form_f229_uuid = $this->input->post('tbl_korduk_akta_kematian_form_f229_uuid');
			$tbl_korduk_akta_kematian_form_f229_name = $this->input->post('tbl_korduk_akta_kematian_form_f229_name');
			$tbl_korduk_akta_kematian_kk_uuid = $this->input->post('tbl_korduk_akta_kematian_kk_uuid');
			$tbl_korduk_akta_kematian_kk_name = $this->input->post('tbl_korduk_akta_kematian_kk_name');
			$tbl_korduk_akta_kematian_ktp_uuid = $this->input->post('tbl_korduk_akta_kematian_ktp_uuid');
			$tbl_korduk_akta_kematian_ktp_name = $this->input->post('tbl_korduk_akta_kematian_ktp_name');
			$tbl_korduk_akta_kematian_suket_kematian_uuid = $this->input->post('tbl_korduk_akta_kematian_suket_kematian_uuid');
			$tbl_korduk_akta_kematian_suket_kematian_name = $this->input->post('tbl_korduk_akta_kematian_suket_kematian_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_kematian/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_kematian/');
			}

			if (!empty($tbl_korduk_akta_kematian_form_f229_uuid)) {
				$tbl_korduk_akta_kematian_form_f229_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_form_f229_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_form_f229_uuid . '/' . $tbl_korduk_akta_kematian_form_f229_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_form_f229_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_form_f229_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f229'] = $tbl_korduk_akta_kematian_form_f229_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_kk_uuid)) {
				$tbl_korduk_akta_kematian_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_kk_uuid . '/' . $tbl_korduk_akta_kematian_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_kematian_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_ktp_uuid)) {
				$tbl_korduk_akta_kematian_ktp_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_ktp_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_ktp_uuid . '/' . $tbl_korduk_akta_kematian_ktp_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_ktp_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_ktp_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp'] = $tbl_korduk_akta_kematian_ktp_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kematian_suket_kematian_uuid)) {
				$tbl_korduk_akta_kematian_suket_kematian_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kematian_suket_kematian_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kematian_suket_kematian_uuid . '/' . $tbl_korduk_akta_kematian_suket_kematian_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_suket_kematian_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian_suket_kematian_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_kematian'] = $tbl_korduk_akta_kematian_suket_kematian_name_copy;
			}
		
			
			$save_tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->change($id, $save_data);

			if ($save_tbl_korduk_akta_kematian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_akta_kematian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_kematian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_kematian');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Kematians
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_akta_kematian_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_akta_kematian'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_akta_kematian'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Akta Kematians
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_akta_kematian_view');

		$this->data['tbl_korduk_akta_kematian'] = $this->model_tbl_korduk_akta_kematian->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Akta Kematian Detail');
		$this->render('modul/tbl_korduk_akta_kematian/tbl_korduk_akta_kematian_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Kematians
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->find($id);

		if (!empty($tbl_korduk_akta_kematian->form_f229)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian->form_f229;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kematian->kk)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kematian->ktp)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian->ktp;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kematian->suket_kematian)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kematian/' . $tbl_korduk_akta_kematian->suket_kematian;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_akta_kematian->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function upload_form_f229_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kematian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function delete_form_f229_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'form_f229', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function get_form_f229_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form_f229', 
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/',
            'delete_endpoint'   => 'tbl_korduk_akta_kematian/delete_form_f229_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kematian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/',
            'delete_endpoint'   => 'tbl_korduk_akta_kematian/delete_kk_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function upload_ktp_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kematian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function delete_ktp_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function get_ktp_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp', 
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/',
            'delete_endpoint'   => 'tbl_korduk_akta_kematian/delete_ktp_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function upload_suket_kematian_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kematian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function delete_suket_kematian_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'suket_kematian', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kematian	* 
	* @return JSON
	*/
	public function get_suket_kematian_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kematian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kematian = $this->model_tbl_korduk_akta_kematian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_kematian', 
            'table_name'        => 'tbl_korduk_akta_kematian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kematian/',
            'delete_endpoint'   => 'tbl_korduk_akta_kematian/delete_suket_kematian_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_akta_kematian_export');

		$this->model_tbl_korduk_akta_kematian->export('tbl_korduk_akta_kematian', 'tbl_korduk_akta_kematian');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_akta_kematian_export');

		$this->model_tbl_korduk_akta_kematian->pdf('tbl_korduk_akta_kematian', 'tbl_korduk_akta_kematian');
	}
}


/* End of file tbl_korduk_akta_kematian.php */
/* Location: ./application/controllers/Tbl Korduk Akta Kematian.php */