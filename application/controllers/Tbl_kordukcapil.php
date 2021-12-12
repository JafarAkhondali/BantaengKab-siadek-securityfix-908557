<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Kordukcapil Controller
*| --------------------------------------------------------------------------
*| Tbl Kordukcapil site
*|
*/
class Tbl_kordukcapil extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_kordukcapil');
	}

	/**
	* show all Tbl Kordukcapils
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_kordukcapil_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_kordukcapils'] = $this->model_tbl_kordukcapil->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_kordukcapil_counts'] = $this->model_tbl_kordukcapil->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_kordukcapil/index/',
			'total_rows'   => $this->model_tbl_kordukcapil->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Akta Perkawinan 2 List');
		$this->render('modul/tbl_kordukcapil/tbl_kordukcapil_list', $this->data);
	}
	
	/**
	* Add new tbl_kordukcapils
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_kordukcapil_add');

		$this->template->title('Adminduk Akta Perkawinan 2 New');
		$this->render('modul/tbl_kordukcapil/tbl_kordukcapil_add', $this->data);
	}

	/**
	* Add New Tbl Kordukcapils
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_kordukcapil_form_name', 'Form', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_kk_name', 'Kk', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ktp1_name', 'KTP Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ktp2_name', 'KTP Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_surat_nikah_name', 'Surat Nikah', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_hilang_name', 'Suket Hilang', 'trim');
		$this->form_validation->set_rules('tbl_kordukcapil_akta_kelahiran_suami_name', 'Akta Kelahiran Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_akta_kelahiran_istri_name', 'Akta Kelahiran Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ijazah_suami_name', 'Ijazah Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ijazah_istri_name', 'Ijazah Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_pas_foto_name', 'Pas Foto', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_pernikahan_name', 'Suket Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_desa_name', 'Suket Desa', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_surat_pengantar_name', 'Surat Izin Atasan', 'trim');
		

		if ($this->form_validation->run()) {
			$tbl_kordukcapil_form_uuid = $this->input->post('tbl_kordukcapil_form_uuid');
			$tbl_kordukcapil_form_name = $this->input->post('tbl_kordukcapil_form_name');
			$tbl_kordukcapil_kk_uuid = $this->input->post('tbl_kordukcapil_kk_uuid');
			$tbl_kordukcapil_kk_name = $this->input->post('tbl_kordukcapil_kk_name');
			$tbl_kordukcapil_ktp1_uuid = $this->input->post('tbl_kordukcapil_ktp1_uuid');
			$tbl_kordukcapil_ktp1_name = $this->input->post('tbl_kordukcapil_ktp1_name');
			$tbl_kordukcapil_ktp2_uuid = $this->input->post('tbl_kordukcapil_ktp2_uuid');
			$tbl_kordukcapil_ktp2_name = $this->input->post('tbl_kordukcapil_ktp2_name');
			$tbl_kordukcapil_surat_nikah_uuid = $this->input->post('tbl_kordukcapil_surat_nikah_uuid');
			$tbl_kordukcapil_surat_nikah_name = $this->input->post('tbl_kordukcapil_surat_nikah_name');
			$tbl_kordukcapil_suket_hilang_uuid = $this->input->post('tbl_kordukcapil_suket_hilang_uuid');
			$tbl_kordukcapil_suket_hilang_name = $this->input->post('tbl_kordukcapil_suket_hilang_name');
			$tbl_kordukcapil_akta_kelahiran_suami_uuid = $this->input->post('tbl_kordukcapil_akta_kelahiran_suami_uuid');
			$tbl_kordukcapil_akta_kelahiran_suami_name = $this->input->post('tbl_kordukcapil_akta_kelahiran_suami_name');
			$tbl_kordukcapil_akta_kelahiran_istri_uuid = $this->input->post('tbl_kordukcapil_akta_kelahiran_istri_uuid');
			$tbl_kordukcapil_akta_kelahiran_istri_name = $this->input->post('tbl_kordukcapil_akta_kelahiran_istri_name');
			$tbl_kordukcapil_ijazah_suami_uuid = $this->input->post('tbl_kordukcapil_ijazah_suami_uuid');
			$tbl_kordukcapil_ijazah_suami_name = $this->input->post('tbl_kordukcapil_ijazah_suami_name');
			$tbl_kordukcapil_ijazah_istri_uuid = $this->input->post('tbl_kordukcapil_ijazah_istri_uuid');
			$tbl_kordukcapil_ijazah_istri_name = $this->input->post('tbl_kordukcapil_ijazah_istri_name');
			$tbl_kordukcapil_pas_foto_uuid = $this->input->post('tbl_kordukcapil_pas_foto_uuid');
			$tbl_kordukcapil_pas_foto_name = $this->input->post('tbl_kordukcapil_pas_foto_name');
			$tbl_kordukcapil_suket_pernikahan_uuid = $this->input->post('tbl_kordukcapil_suket_pernikahan_uuid');
			$tbl_kordukcapil_suket_pernikahan_name = $this->input->post('tbl_kordukcapil_suket_pernikahan_name');
			$tbl_kordukcapil_suket_desa_uuid = $this->input->post('tbl_kordukcapil_suket_desa_uuid');
			$tbl_kordukcapil_suket_desa_name = $this->input->post('tbl_kordukcapil_suket_desa_name');
			$tbl_kordukcapil_surat_pengantar_uuid = $this->input->post('tbl_kordukcapil_surat_pengantar_uuid');
			$tbl_kordukcapil_surat_pengantar_name = $this->input->post('tbl_kordukcapil_surat_pengantar_name');
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_kordukcapil/')) {
				mkdir(FCPATH . '/uploads/tbl_kordukcapil/');
			}

			if (!empty($tbl_kordukcapil_form_name)) {
				$tbl_kordukcapil_form_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_form_uuid . '/' . $tbl_kordukcapil_form_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_kordukcapil_form_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_kk_name)) {
				$tbl_kordukcapil_kk_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_kk_uuid . '/' . $tbl_kordukcapil_kk_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_kordukcapil_kk_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ktp1_name)) {
				$tbl_kordukcapil_ktp1_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ktp1_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ktp1_uuid . '/' . $tbl_kordukcapil_ktp1_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp1_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp1_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp1'] = $tbl_kordukcapil_ktp1_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ktp2_name)) {
				$tbl_kordukcapil_ktp2_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ktp2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ktp2_uuid . '/' . $tbl_kordukcapil_ktp2_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp2'] = $tbl_kordukcapil_ktp2_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_surat_nikah_name)) {
				$tbl_kordukcapil_surat_nikah_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_surat_nikah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_surat_nikah_uuid . '/' . $tbl_kordukcapil_surat_nikah_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_nikah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_nikah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_nikah'] = $tbl_kordukcapil_surat_nikah_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_hilang_name)) {
				$tbl_kordukcapil_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_hilang_uuid . '/' . $tbl_kordukcapil_suket_hilang_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_kordukcapil_suket_hilang_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_akta_kelahiran_suami_name)) {
				$tbl_kordukcapil_akta_kelahiran_suami_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_akta_kelahiran_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_akta_kelahiran_suami_uuid . '/' . $tbl_kordukcapil_akta_kelahiran_suami_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_suami'] = $tbl_kordukcapil_akta_kelahiran_suami_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_akta_kelahiran_istri_name)) {
				$tbl_kordukcapil_akta_kelahiran_istri_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_akta_kelahiran_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_akta_kelahiran_istri_uuid . '/' . $tbl_kordukcapil_akta_kelahiran_istri_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_istri'] = $tbl_kordukcapil_akta_kelahiran_istri_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ijazah_suami_name)) {
				$tbl_kordukcapil_ijazah_suami_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ijazah_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ijazah_suami_uuid . '/' . $tbl_kordukcapil_ijazah_suami_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_suami'] = $tbl_kordukcapil_ijazah_suami_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ijazah_istri_name)) {
				$tbl_kordukcapil_ijazah_istri_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ijazah_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ijazah_istri_uuid . '/' . $tbl_kordukcapil_ijazah_istri_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_istri'] = $tbl_kordukcapil_ijazah_istri_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_pas_foto_name)) {
				$tbl_kordukcapil_pas_foto_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_pas_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_pas_foto_uuid . '/' . $tbl_kordukcapil_pas_foto_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_pas_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_pas_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['pas_foto'] = $tbl_kordukcapil_pas_foto_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_pernikahan_name)) {
				$tbl_kordukcapil_suket_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_pernikahan_uuid . '/' . $tbl_kordukcapil_suket_pernikahan_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_pernikahan'] = $tbl_kordukcapil_suket_pernikahan_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_desa_name)) {
				$tbl_kordukcapil_suket_desa_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_desa_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_desa_uuid . '/' . $tbl_kordukcapil_suket_desa_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_desa_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_desa_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_desa'] = $tbl_kordukcapil_suket_desa_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_surat_pengantar_name)) {
				$tbl_kordukcapil_surat_pengantar_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_surat_pengantar_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_surat_pengantar_uuid . '/' . $tbl_kordukcapil_surat_pengantar_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_pengantar_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_pengantar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pengantar'] = $tbl_kordukcapil_surat_pengantar_name_copy;
			}
		
			
			$save_tbl_kordukcapil = $this->model_tbl_kordukcapil->store($save_data);

			if ($save_tbl_kordukcapil) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_kordukcapil;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_kordukcapil/edit/' . $save_tbl_kordukcapil, 'Edit Tbl Kordukcapil'),
						anchor('tbl_kordukcapil', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_kordukcapil/edit/' . $save_tbl_kordukcapil, 'Edit Tbl Kordukcapil')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_kordukcapil');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_kordukcapil');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Kordukcapils
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_kordukcapil_update');

		$this->data['tbl_kordukcapil'] = $this->model_tbl_kordukcapil->find($id);

		$this->template->title('Adminduk Akta Perkawinan 2 Update');
		$this->render('modul/tbl_kordukcapil/tbl_kordukcapil_update', $this->data);
	}

	/**
	* Update Tbl Kordukcapils
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_kordukcapil_form_name', 'Form', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_kk_name', 'Kk', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ktp1_name', 'KTP Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ktp2_name', 'KTP Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_surat_nikah_name', 'Surat Nikah', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_hilang_name', 'Suket Hilang', 'trim');
		$this->form_validation->set_rules('tbl_kordukcapil_akta_kelahiran_suami_name', 'Akta Kelahiran Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_akta_kelahiran_istri_name', 'Akta Kelahiran Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ijazah_suami_name', 'Ijazah Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_ijazah_istri_name', 'Ijazah Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_pas_foto_name', 'Pas Foto', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_pernikahan_name', 'Suket Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_suket_desa_name', 'Suket Desa', 'trim|required');
		$this->form_validation->set_rules('tbl_kordukcapil_surat_pengantar_name', 'Surat Izin Atasan', 'trim');
		
		if ($this->form_validation->run()) {
			$tbl_kordukcapil_form_uuid = $this->input->post('tbl_kordukcapil_form_uuid');
			$tbl_kordukcapil_form_name = $this->input->post('tbl_kordukcapil_form_name');
			$tbl_kordukcapil_kk_uuid = $this->input->post('tbl_kordukcapil_kk_uuid');
			$tbl_kordukcapil_kk_name = $this->input->post('tbl_kordukcapil_kk_name');
			$tbl_kordukcapil_ktp1_uuid = $this->input->post('tbl_kordukcapil_ktp1_uuid');
			$tbl_kordukcapil_ktp1_name = $this->input->post('tbl_kordukcapil_ktp1_name');
			$tbl_kordukcapil_ktp2_uuid = $this->input->post('tbl_kordukcapil_ktp2_uuid');
			$tbl_kordukcapil_ktp2_name = $this->input->post('tbl_kordukcapil_ktp2_name');
			$tbl_kordukcapil_surat_nikah_uuid = $this->input->post('tbl_kordukcapil_surat_nikah_uuid');
			$tbl_kordukcapil_surat_nikah_name = $this->input->post('tbl_kordukcapil_surat_nikah_name');
			$tbl_kordukcapil_suket_hilang_uuid = $this->input->post('tbl_kordukcapil_suket_hilang_uuid');
			$tbl_kordukcapil_suket_hilang_name = $this->input->post('tbl_kordukcapil_suket_hilang_name');
			$tbl_kordukcapil_akta_kelahiran_suami_uuid = $this->input->post('tbl_kordukcapil_akta_kelahiran_suami_uuid');
			$tbl_kordukcapil_akta_kelahiran_suami_name = $this->input->post('tbl_kordukcapil_akta_kelahiran_suami_name');
			$tbl_kordukcapil_akta_kelahiran_istri_uuid = $this->input->post('tbl_kordukcapil_akta_kelahiran_istri_uuid');
			$tbl_kordukcapil_akta_kelahiran_istri_name = $this->input->post('tbl_kordukcapil_akta_kelahiran_istri_name');
			$tbl_kordukcapil_ijazah_suami_uuid = $this->input->post('tbl_kordukcapil_ijazah_suami_uuid');
			$tbl_kordukcapil_ijazah_suami_name = $this->input->post('tbl_kordukcapil_ijazah_suami_name');
			$tbl_kordukcapil_ijazah_istri_uuid = $this->input->post('tbl_kordukcapil_ijazah_istri_uuid');
			$tbl_kordukcapil_ijazah_istri_name = $this->input->post('tbl_kordukcapil_ijazah_istri_name');
			$tbl_kordukcapil_pas_foto_uuid = $this->input->post('tbl_kordukcapil_pas_foto_uuid');
			$tbl_kordukcapil_pas_foto_name = $this->input->post('tbl_kordukcapil_pas_foto_name');
			$tbl_kordukcapil_suket_pernikahan_uuid = $this->input->post('tbl_kordukcapil_suket_pernikahan_uuid');
			$tbl_kordukcapil_suket_pernikahan_name = $this->input->post('tbl_kordukcapil_suket_pernikahan_name');
			$tbl_kordukcapil_suket_desa_uuid = $this->input->post('tbl_kordukcapil_suket_desa_uuid');
			$tbl_kordukcapil_suket_desa_name = $this->input->post('tbl_kordukcapil_suket_desa_name');
			$tbl_kordukcapil_surat_pengantar_uuid = $this->input->post('tbl_kordukcapil_surat_pengantar_uuid');
			$tbl_kordukcapil_surat_pengantar_name = $this->input->post('tbl_kordukcapil_surat_pengantar_name');
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_kordukcapil/')) {
				mkdir(FCPATH . '/uploads/tbl_kordukcapil/');
			}

			if (!empty($tbl_kordukcapil_form_uuid)) {
				$tbl_kordukcapil_form_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_form_uuid . '/' . $tbl_kordukcapil_form_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_kordukcapil_form_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_kk_uuid)) {
				$tbl_kordukcapil_kk_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_kk_uuid . '/' . $tbl_kordukcapil_kk_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_kordukcapil_kk_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ktp1_uuid)) {
				$tbl_kordukcapil_ktp1_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ktp1_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ktp1_uuid . '/' . $tbl_kordukcapil_ktp1_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp1_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp1_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp1'] = $tbl_kordukcapil_ktp1_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ktp2_uuid)) {
				$tbl_kordukcapil_ktp2_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ktp2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ktp2_uuid . '/' . $tbl_kordukcapil_ktp2_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ktp2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp2'] = $tbl_kordukcapil_ktp2_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_surat_nikah_uuid)) {
				$tbl_kordukcapil_surat_nikah_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_surat_nikah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_surat_nikah_uuid . '/' . $tbl_kordukcapil_surat_nikah_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_nikah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_nikah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_nikah'] = $tbl_kordukcapil_surat_nikah_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_hilang_uuid)) {
				$tbl_kordukcapil_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_hilang_uuid . '/' . $tbl_kordukcapil_suket_hilang_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_kordukcapil_suket_hilang_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_akta_kelahiran_suami_uuid)) {
				$tbl_kordukcapil_akta_kelahiran_suami_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_akta_kelahiran_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_akta_kelahiran_suami_uuid . '/' . $tbl_kordukcapil_akta_kelahiran_suami_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_suami'] = $tbl_kordukcapil_akta_kelahiran_suami_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_akta_kelahiran_istri_uuid)) {
				$tbl_kordukcapil_akta_kelahiran_istri_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_akta_kelahiran_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_akta_kelahiran_istri_uuid . '/' . $tbl_kordukcapil_akta_kelahiran_istri_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_akta_kelahiran_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_istri'] = $tbl_kordukcapil_akta_kelahiran_istri_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ijazah_suami_uuid)) {
				$tbl_kordukcapil_ijazah_suami_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ijazah_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ijazah_suami_uuid . '/' . $tbl_kordukcapil_ijazah_suami_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_suami'] = $tbl_kordukcapil_ijazah_suami_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_ijazah_istri_uuid)) {
				$tbl_kordukcapil_ijazah_istri_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_ijazah_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_ijazah_istri_uuid . '/' . $tbl_kordukcapil_ijazah_istri_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_ijazah_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_istri'] = $tbl_kordukcapil_ijazah_istri_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_pas_foto_uuid)) {
				$tbl_kordukcapil_pas_foto_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_pas_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_pas_foto_uuid . '/' . $tbl_kordukcapil_pas_foto_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_pas_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_pas_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['pas_foto'] = $tbl_kordukcapil_pas_foto_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_pernikahan_uuid)) {
				$tbl_kordukcapil_suket_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_pernikahan_uuid . '/' . $tbl_kordukcapil_suket_pernikahan_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_pernikahan'] = $tbl_kordukcapil_suket_pernikahan_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_suket_desa_uuid)) {
				$tbl_kordukcapil_suket_desa_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_suket_desa_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_suket_desa_uuid . '/' . $tbl_kordukcapil_suket_desa_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_desa_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_suket_desa_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_desa'] = $tbl_kordukcapil_suket_desa_name_copy;
			}
		
			if (!empty($tbl_kordukcapil_surat_pengantar_uuid)) {
				$tbl_kordukcapil_surat_pengantar_name_copy = date('YmdHis') . '-' . $tbl_kordukcapil_surat_pengantar_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_kordukcapil_surat_pengantar_uuid . '/' . $tbl_kordukcapil_surat_pengantar_name, 
						FCPATH . 'uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_pengantar_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil_surat_pengantar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pengantar'] = $tbl_kordukcapil_surat_pengantar_name_copy;
			}
		
			
			$save_tbl_kordukcapil = $this->model_tbl_kordukcapil->change($id, $save_data);

			if ($save_tbl_kordukcapil) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_kordukcapil', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_kordukcapil');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_kordukcapil');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Kordukcapils
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_kordukcapil_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_kordukcapil'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_kordukcapil'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Kordukcapils
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_kordukcapil_view');

		$this->data['tbl_kordukcapil'] = $this->model_tbl_kordukcapil->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Akta Perkawinan 2 Detail');
		$this->render('modul/tbl_kordukcapil/tbl_kordukcapil_view', $this->data);
	}
	
	/**
	* delete Tbl Kordukcapils
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		if (!empty($tbl_kordukcapil->form)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->form;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->kk)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->ktp1)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->ktp1;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->ktp2)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->ktp2;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->surat_nikah)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->surat_nikah;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->suket_hilang)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->suket_hilang;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->akta_kelahiran_suami)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->akta_kelahiran_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->akta_kelahiran_istri)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->akta_kelahiran_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->ijazah_suami)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->ijazah_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->ijazah_istri)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->ijazah_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->pas_foto)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->pas_foto;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->suket_pernikahan)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->suket_pernikahan;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->suket_desa)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->suket_desa;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_kordukcapil->surat_pengantar)) {
			$path = FCPATH . '/uploads/tbl_kordukcapil/' . $tbl_kordukcapil->surat_pengantar;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_kordukcapil->remove($id);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_form_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_form_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
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
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_form_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_form_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
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
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_kk_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_ktp1_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_ktp1_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp1', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_ktp1_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp1', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_ktp1_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_ktp2_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_ktp2_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp2', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_ktp2_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp2', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_ktp2_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_surat_nikah_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_surat_nikah_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'surat_nikah', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_surat_nikah_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_nikah', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_surat_nikah_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_suket_hilang_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_suket_hilang_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
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
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_suket_hilang_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_hilang', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_suket_hilang_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_akta_kelahiran_suami_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_akta_kelahiran_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'akta_kelahiran_suami', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_akta_kelahiran_suami_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_kelahiran_suami', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_akta_kelahiran_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_akta_kelahiran_istri_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_akta_kelahiran_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'akta_kelahiran_istri', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_akta_kelahiran_istri_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_kelahiran_istri', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_akta_kelahiran_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_ijazah_suami_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_ijazah_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ijazah_suami', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_ijazah_suami_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ijazah_suami', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_ijazah_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_ijazah_istri_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_ijazah_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ijazah_istri', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_ijazah_istri_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ijazah_istri', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_ijazah_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_pas_foto_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_pas_foto_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'pas_foto', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_pas_foto_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'pas_foto', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_pas_foto_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_suket_pernikahan_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_suket_pernikahan_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'suket_pernikahan', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_suket_pernikahan_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_pernikahan', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_suket_pernikahan_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_suket_desa_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_suket_desa_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'suket_desa', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_suket_desa_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_desa', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_suket_desa_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function upload_surat_pengantar_file()
	{
		if (!$this->is_allowed('tbl_kordukcapil_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_kordukcapil',
			'allowed_types' => 'jpg| pdf| png',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function delete_surat_pengantar_file($uuid)
	{
		if (!$this->is_allowed('tbl_kordukcapil_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'surat_pengantar', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/'
        ]);
	}

	/**
	* Get Image Tbl Kordukcapil	* 
	* @return JSON
	*/
	public function get_surat_pengantar_file($id)
	{
		if (!$this->is_allowed('tbl_kordukcapil_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_kordukcapil = $this->model_tbl_kordukcapil->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_pengantar', 
            'table_name'        => 'tbl_kordukcapil',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_kordukcapil/',
            'delete_endpoint'   => 'tbl_kordukcapil/delete_surat_pengantar_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_kordukcapil_export');

		$this->model_tbl_kordukcapil->export('tbl_kordukcapil', 'tbl_kordukcapil');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_kordukcapil_export');

		$this->model_tbl_kordukcapil->pdf('tbl_kordukcapil', 'tbl_kordukcapil');
	}
}


/* End of file tbl_kordukcapil.php */
/* Location: ./application/controllers/Tbl Kordukcapil.php */