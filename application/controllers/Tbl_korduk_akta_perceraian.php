<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Perceraian Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Perceraian site
*|
*/
class Tbl_korduk_akta_perceraian extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_akta_perceraian');
	}

	/**
	* show all Tbl Korduk Akta Perceraians
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_akta_perceraians'] = $this->model_tbl_korduk_akta_perceraian->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_akta_perceraian_counts'] = $this->model_tbl_korduk_akta_perceraian->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_akta_perceraian/index/',
			'total_rows'   => $this->model_tbl_korduk_akta_perceraian->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Akta Perceraian List');
		$this->render('modul/tbl_korduk_akta_perceraian/tbl_korduk_akta_perceraian_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_akta_perceraians
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_add');

		$this->template->title('Adminduk Akta Perceraian New');
		$this->render('modul/tbl_korduk_akta_perceraian/tbl_korduk_akta_perceraian_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Akta Perceraians
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_form_name', 'Form F-2.19', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_ktp_suami_name', 'KTP Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_ktp_istri_name', 'KTP Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_putusan_pengadilan_name', 'Putusan Pengadilan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_akta_pernikahan_name', 'Akta Pernikahan', 'trim|required');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_akta_perceraian_form_uuid = $this->input->post('tbl_korduk_akta_perceraian_form_uuid');
			$tbl_korduk_akta_perceraian_form_name = $this->input->post('tbl_korduk_akta_perceraian_form_name');
			$tbl_korduk_akta_perceraian_ktp_suami_uuid = $this->input->post('tbl_korduk_akta_perceraian_ktp_suami_uuid');
			$tbl_korduk_akta_perceraian_ktp_suami_name = $this->input->post('tbl_korduk_akta_perceraian_ktp_suami_name');
			$tbl_korduk_akta_perceraian_ktp_istri_uuid = $this->input->post('tbl_korduk_akta_perceraian_ktp_istri_uuid');
			$tbl_korduk_akta_perceraian_ktp_istri_name = $this->input->post('tbl_korduk_akta_perceraian_ktp_istri_name');
			$tbl_korduk_akta_perceraian_putusan_pengadilan_uuid = $this->input->post('tbl_korduk_akta_perceraian_putusan_pengadilan_uuid');
			$tbl_korduk_akta_perceraian_putusan_pengadilan_name = $this->input->post('tbl_korduk_akta_perceraian_putusan_pengadilan_name');
			$tbl_korduk_akta_perceraian_akta_pernikahan_uuid = $this->input->post('tbl_korduk_akta_perceraian_akta_pernikahan_uuid');
			$tbl_korduk_akta_perceraian_akta_pernikahan_name = $this->input->post('tbl_korduk_akta_perceraian_akta_pernikahan_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_perceraian/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_perceraian/');
			}

			if (!empty($tbl_korduk_akta_perceraian_form_name)) {
				$tbl_korduk_akta_perceraian_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_form_uuid . '/' . $tbl_korduk_akta_perceraian_form_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_akta_perceraian_form_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_ktp_suami_name)) {
				$tbl_korduk_akta_perceraian_ktp_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_ktp_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_ktp_suami_uuid . '/' . $tbl_korduk_akta_perceraian_ktp_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_suami'] = $tbl_korduk_akta_perceraian_ktp_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_ktp_istri_name)) {
				$tbl_korduk_akta_perceraian_ktp_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_ktp_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_ktp_istri_uuid . '/' . $tbl_korduk_akta_perceraian_ktp_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_istri'] = $tbl_korduk_akta_perceraian_ktp_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_putusan_pengadilan_name)) {
				$tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_uuid . '/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['putusan_pengadilan'] = $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_akta_pernikahan_name)) {
				$tbl_korduk_akta_perceraian_akta_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_akta_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_akta_pernikahan_uuid . '/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_pernikahan'] = $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy;
			}
		
			
			$save_tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->store($save_data);

			if ($save_tbl_korduk_akta_perceraian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_akta_perceraian;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_akta_perceraian/edit/' . $save_tbl_korduk_akta_perceraian, 'Edit Tbl Korduk Akta Perceraian'),
						anchor('tbl_korduk_akta_perceraian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_akta_perceraian/edit/' . $save_tbl_korduk_akta_perceraian, 'Edit Tbl Korduk Akta Perceraian')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_perceraian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_perceraian');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Akta Perceraians
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_update');

		$this->data['tbl_korduk_akta_perceraian'] = $this->model_tbl_korduk_akta_perceraian->find($id);

		$this->template->title('Adminduk Akta Perceraian Update');
		$this->render('modul/tbl_korduk_akta_perceraian/tbl_korduk_akta_perceraian_update', $this->data);
	}

	/**
	* Update Tbl Korduk Akta Perceraians
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_form_name', 'Form F-2.19', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_ktp_suami_name', 'KTP Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_ktp_istri_name', 'KTP Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_putusan_pengadilan_name', 'Putusan Pengadilan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_perceraian_akta_pernikahan_name', 'Akta Pernikahan', 'trim|required');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_akta_perceraian_form_uuid = $this->input->post('tbl_korduk_akta_perceraian_form_uuid');
			$tbl_korduk_akta_perceraian_form_name = $this->input->post('tbl_korduk_akta_perceraian_form_name');
			$tbl_korduk_akta_perceraian_ktp_suami_uuid = $this->input->post('tbl_korduk_akta_perceraian_ktp_suami_uuid');
			$tbl_korduk_akta_perceraian_ktp_suami_name = $this->input->post('tbl_korduk_akta_perceraian_ktp_suami_name');
			$tbl_korduk_akta_perceraian_ktp_istri_uuid = $this->input->post('tbl_korduk_akta_perceraian_ktp_istri_uuid');
			$tbl_korduk_akta_perceraian_ktp_istri_name = $this->input->post('tbl_korduk_akta_perceraian_ktp_istri_name');
			$tbl_korduk_akta_perceraian_putusan_pengadilan_uuid = $this->input->post('tbl_korduk_akta_perceraian_putusan_pengadilan_uuid');
			$tbl_korduk_akta_perceraian_putusan_pengadilan_name = $this->input->post('tbl_korduk_akta_perceraian_putusan_pengadilan_name');
			$tbl_korduk_akta_perceraian_akta_pernikahan_uuid = $this->input->post('tbl_korduk_akta_perceraian_akta_pernikahan_uuid');
			$tbl_korduk_akta_perceraian_akta_pernikahan_name = $this->input->post('tbl_korduk_akta_perceraian_akta_pernikahan_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_perceraian/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_perceraian/');
			}

			if (!empty($tbl_korduk_akta_perceraian_form_uuid)) {
				$tbl_korduk_akta_perceraian_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_form_uuid . '/' . $tbl_korduk_akta_perceraian_form_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_akta_perceraian_form_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_ktp_suami_uuid)) {
				$tbl_korduk_akta_perceraian_ktp_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_ktp_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_ktp_suami_uuid . '/' . $tbl_korduk_akta_perceraian_ktp_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_suami'] = $tbl_korduk_akta_perceraian_ktp_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_ktp_istri_uuid)) {
				$tbl_korduk_akta_perceraian_ktp_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_ktp_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_ktp_istri_uuid . '/' . $tbl_korduk_akta_perceraian_ktp_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_ktp_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_istri'] = $tbl_korduk_akta_perceraian_ktp_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_putusan_pengadilan_uuid)) {
				$tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_uuid . '/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['putusan_pengadilan'] = $tbl_korduk_akta_perceraian_putusan_pengadilan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_perceraian_akta_pernikahan_uuid)) {
				$tbl_korduk_akta_perceraian_akta_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_perceraian_akta_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_perceraian_akta_pernikahan_uuid . '/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_pernikahan'] = $tbl_korduk_akta_perceraian_akta_pernikahan_name_copy;
			}
		
			
			$save_tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->change($id, $save_data);

			if ($save_tbl_korduk_akta_perceraian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_akta_perceraian', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_perceraian');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_perceraian');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Perceraians
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_akta_perceraian'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_akta_perceraian'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Akta Perceraians
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_view');

		$this->data['tbl_korduk_akta_perceraian'] = $this->model_tbl_korduk_akta_perceraian->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Akta Perceraian Detail');
		$this->render('modul/tbl_korduk_akta_perceraian/tbl_korduk_akta_perceraian_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Perceraians
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		if (!empty($tbl_korduk_akta_perceraian->form)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian->form;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_perceraian->ktp_suami)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian->ktp_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_perceraian->ktp_istri)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian->ktp_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_perceraian->putusan_pengadilan)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian->putusan_pengadilan;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_perceraian->akta_pernikahan)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_perceraian/' . $tbl_korduk_akta_perceraian->akta_pernikahan;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_akta_perceraian->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function upload_form_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_perceraian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function delete_form_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function get_form_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form', 
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/',
            'delete_endpoint'   => 'tbl_korduk_akta_perceraian/delete_form_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function upload_ktp_suami_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_perceraian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function delete_ktp_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp_suami', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function get_ktp_suami_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_suami', 
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/',
            'delete_endpoint'   => 'tbl_korduk_akta_perceraian/delete_ktp_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function upload_ktp_istri_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_perceraian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function delete_ktp_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp_istri', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function get_ktp_istri_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_istri', 
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/',
            'delete_endpoint'   => 'tbl_korduk_akta_perceraian/delete_ktp_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function upload_putusan_pengadilan_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_perceraian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function delete_putusan_pengadilan_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'putusan_pengadilan', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function get_putusan_pengadilan_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'putusan_pengadilan', 
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/',
            'delete_endpoint'   => 'tbl_korduk_akta_perceraian/delete_putusan_pengadilan_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function upload_akta_pernikahan_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_perceraian',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function delete_akta_pernikahan_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'akta_pernikahan', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Perceraian	* 
	* @return JSON
	*/
	public function get_akta_pernikahan_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_perceraian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_perceraian = $this->model_tbl_korduk_akta_perceraian->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_pernikahan', 
            'table_name'        => 'tbl_korduk_akta_perceraian',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_perceraian/',
            'delete_endpoint'   => 'tbl_korduk_akta_perceraian/delete_akta_pernikahan_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_export');

		$this->model_tbl_korduk_akta_perceraian->export('tbl_korduk_akta_perceraian', 'tbl_korduk_akta_perceraian');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_akta_perceraian_export');

		$this->model_tbl_korduk_akta_perceraian->pdf('tbl_korduk_akta_perceraian', 'tbl_korduk_akta_perceraian');
	}
}


/* End of file tbl_korduk_akta_perceraian.php */
/* Location: ./application/controllers/Tbl Korduk Akta Perceraian.php */