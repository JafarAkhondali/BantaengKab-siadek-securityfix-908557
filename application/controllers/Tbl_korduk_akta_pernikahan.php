<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Pernikahan Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Pernikahan site
*|
*/
class Tbl_korduk_akta_pernikahan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_akta_pernikahan');
	}

	/**
	* show all Tbl Korduk Akta Pernikahans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_akta_pernikahans'] = $this->model_tbl_korduk_akta_pernikahan->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_akta_pernikahan_counts'] = $this->model_tbl_korduk_akta_pernikahan->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_akta_pernikahan/index/',
			'total_rows'   => $this->model_tbl_korduk_akta_pernikahan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Akta Pernikahan List');
		$this->render('modul/tbl_korduk_akta_pernikahan/tbl_korduk_akta_pernikahan_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_akta_pernikahans
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_add');

		$this->template->title('Adminduk Akta Pernikahan New');
		$this->render('modul/tbl_korduk_akta_pernikahan/tbl_korduk_akta_pernikahan_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Akta Pernikahans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_form_name', 'Form F-2.12', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ktp_suami_name', 'KTP Suami', 'trim');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ktp_istri_name', 'KTP Istri', 'trim');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name', 'Akta Kelahiran Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name', 'Akta Kelahiran Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ijazah_suami_name', 'Ijazah Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ijazah_istri_name', 'Ijazah Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_pas_foto_name', 'Pas Foto', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_suket_pernikahan_name', 'Suket Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_suket_desa_name', 'Suket Desa', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_form2_name', 'Form F-2.01', 'trim|required');
		$this->form_validation->set_rules('created_by', 'Created By', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_akta_pernikahan_form_uuid = $this->input->post('tbl_korduk_akta_pernikahan_form_uuid');
			$tbl_korduk_akta_pernikahan_form_name = $this->input->post('tbl_korduk_akta_pernikahan_form_name');
			$tbl_korduk_akta_pernikahan_ktp_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ktp_suami_uuid');
			$tbl_korduk_akta_pernikahan_ktp_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_ktp_suami_name');
			$tbl_korduk_akta_pernikahan_ktp_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ktp_istri_uuid');
			$tbl_korduk_akta_pernikahan_ktp_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_ktp_istri_name');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name');
			$tbl_korduk_akta_pernikahan_ijazah_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_suami_uuid');
			$tbl_korduk_akta_pernikahan_ijazah_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_suami_name');
			$tbl_korduk_akta_pernikahan_ijazah_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_istri_uuid');
			$tbl_korduk_akta_pernikahan_ijazah_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_istri_name');
			$tbl_korduk_akta_pernikahan_pas_foto_uuid = $this->input->post('tbl_korduk_akta_pernikahan_pas_foto_uuid');
			$tbl_korduk_akta_pernikahan_pas_foto_name = $this->input->post('tbl_korduk_akta_pernikahan_pas_foto_name');
			$tbl_korduk_akta_pernikahan_suket_pernikahan_uuid = $this->input->post('tbl_korduk_akta_pernikahan_suket_pernikahan_uuid');
			$tbl_korduk_akta_pernikahan_suket_pernikahan_name = $this->input->post('tbl_korduk_akta_pernikahan_suket_pernikahan_name');
			$tbl_korduk_akta_pernikahan_suket_desa_uuid = $this->input->post('tbl_korduk_akta_pernikahan_suket_desa_uuid');
			$tbl_korduk_akta_pernikahan_suket_desa_name = $this->input->post('tbl_korduk_akta_pernikahan_suket_desa_name');
			$tbl_korduk_akta_pernikahan_kk_uuid = $this->input->post('tbl_korduk_akta_pernikahan_kk_uuid');
			$tbl_korduk_akta_pernikahan_kk_name = $this->input->post('tbl_korduk_akta_pernikahan_kk_name');
			$tbl_korduk_akta_pernikahan_form2_uuid = $this->input->post('tbl_korduk_akta_pernikahan_form2_uuid');
			$tbl_korduk_akta_pernikahan_form2_name = $this->input->post('tbl_korduk_akta_pernikahan_form2_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => $this->input->post('created_by'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/');
			}

			if (!empty($tbl_korduk_akta_pernikahan_form_name)) {
				$tbl_korduk_akta_pernikahan_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_form_uuid . '/' . $tbl_korduk_akta_pernikahan_form_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_akta_pernikahan_form_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ktp_suami_name)) {
				$tbl_korduk_akta_pernikahan_ktp_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ktp_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ktp_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_ktp_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_suami'] = $tbl_korduk_akta_pernikahan_ktp_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ktp_istri_name)) {
				$tbl_korduk_akta_pernikahan_ktp_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ktp_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ktp_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_ktp_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_istri'] = $tbl_korduk_akta_pernikahan_ktp_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name)) {
				$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_suami'] = $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name)) {
				$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_istri'] = $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ijazah_suami_name)) {
				$tbl_korduk_akta_pernikahan_ijazah_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ijazah_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ijazah_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_suami'] = $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ijazah_istri_name)) {
				$tbl_korduk_akta_pernikahan_ijazah_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ijazah_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ijazah_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_istri'] = $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_pas_foto_name)) {
				$tbl_korduk_akta_pernikahan_pas_foto_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_pas_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_pas_foto_uuid . '/' . $tbl_korduk_akta_pernikahan_pas_foto_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_pas_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_pas_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['pas_foto'] = $tbl_korduk_akta_pernikahan_pas_foto_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_suket_pernikahan_name)) {
				$tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_uuid . '/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_pernikahan'] = $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_suket_desa_name)) {
				$tbl_korduk_akta_pernikahan_suket_desa_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_suket_desa_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_suket_desa_uuid . '/' . $tbl_korduk_akta_pernikahan_suket_desa_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_desa_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_desa_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_desa'] = $tbl_korduk_akta_pernikahan_suket_desa_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_kk_name)) {
				$tbl_korduk_akta_pernikahan_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_kk_uuid . '/' . $tbl_korduk_akta_pernikahan_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_pernikahan_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_form2_name)) {
				$tbl_korduk_akta_pernikahan_form2_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_form2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_form2_uuid . '/' . $tbl_korduk_akta_pernikahan_form2_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form2'] = $tbl_korduk_akta_pernikahan_form2_name_copy;
			}
		
			
			$save_tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->store($save_data);

			if ($save_tbl_korduk_akta_pernikahan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_akta_pernikahan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_akta_pernikahan/edit/' . $save_tbl_korduk_akta_pernikahan, 'Edit Tbl Korduk Akta Pernikahan'),
						anchor('tbl_korduk_akta_pernikahan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_akta_pernikahan/edit/' . $save_tbl_korduk_akta_pernikahan, 'Edit Tbl Korduk Akta Pernikahan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_pernikahan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_pernikahan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Akta Pernikahans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_update');

		$this->data['tbl_korduk_akta_pernikahan'] = $this->model_tbl_korduk_akta_pernikahan->find($id);

		$this->template->title('Adminduk Akta Pernikahan Update');
		$this->render('modul/tbl_korduk_akta_pernikahan/tbl_korduk_akta_pernikahan_update', $this->data);
	}

	/**
	* Update Tbl Korduk Akta Pernikahans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_form_name', 'Form F-2.12', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ktp_suami_name', 'KTP Suami', 'trim');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ktp_istri_name', 'KTP Istri', 'trim');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name', 'Akta Kelahiran Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name', 'Akta Kelahiran Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ijazah_suami_name', 'Ijazah Suami', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_ijazah_istri_name', 'Ijazah Istri', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_pas_foto_name', 'Pas Foto', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_suket_pernikahan_name', 'Suket Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_suket_desa_name', 'Suket Desa', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_pernikahan_form2_name', 'Form F-2.01', 'trim|required');
		$this->form_validation->set_rules('last_updated_by', 'Last Updated By', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_akta_pernikahan_form_uuid = $this->input->post('tbl_korduk_akta_pernikahan_form_uuid');
			$tbl_korduk_akta_pernikahan_form_name = $this->input->post('tbl_korduk_akta_pernikahan_form_name');
			$tbl_korduk_akta_pernikahan_ktp_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ktp_suami_uuid');
			$tbl_korduk_akta_pernikahan_ktp_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_ktp_suami_name');
			$tbl_korduk_akta_pernikahan_ktp_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ktp_istri_uuid');
			$tbl_korduk_akta_pernikahan_ktp_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_ktp_istri_name');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid');
			$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name');
			$tbl_korduk_akta_pernikahan_ijazah_suami_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_suami_uuid');
			$tbl_korduk_akta_pernikahan_ijazah_suami_name = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_suami_name');
			$tbl_korduk_akta_pernikahan_ijazah_istri_uuid = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_istri_uuid');
			$tbl_korduk_akta_pernikahan_ijazah_istri_name = $this->input->post('tbl_korduk_akta_pernikahan_ijazah_istri_name');
			$tbl_korduk_akta_pernikahan_pas_foto_uuid = $this->input->post('tbl_korduk_akta_pernikahan_pas_foto_uuid');
			$tbl_korduk_akta_pernikahan_pas_foto_name = $this->input->post('tbl_korduk_akta_pernikahan_pas_foto_name');
			$tbl_korduk_akta_pernikahan_suket_pernikahan_uuid = $this->input->post('tbl_korduk_akta_pernikahan_suket_pernikahan_uuid');
			$tbl_korduk_akta_pernikahan_suket_pernikahan_name = $this->input->post('tbl_korduk_akta_pernikahan_suket_pernikahan_name');
			$tbl_korduk_akta_pernikahan_suket_desa_uuid = $this->input->post('tbl_korduk_akta_pernikahan_suket_desa_uuid');
			$tbl_korduk_akta_pernikahan_suket_desa_name = $this->input->post('tbl_korduk_akta_pernikahan_suket_desa_name');
			$tbl_korduk_akta_pernikahan_kk_uuid = $this->input->post('tbl_korduk_akta_pernikahan_kk_uuid');
			$tbl_korduk_akta_pernikahan_kk_name = $this->input->post('tbl_korduk_akta_pernikahan_kk_name');
			$tbl_korduk_akta_pernikahan_form2_uuid = $this->input->post('tbl_korduk_akta_pernikahan_form2_uuid');
			$tbl_korduk_akta_pernikahan_form2_name = $this->input->post('tbl_korduk_akta_pernikahan_form2_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'last_updated_by' => $this->input->post('last_updated_by'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/');
			}

			if (!empty($tbl_korduk_akta_pernikahan_form_uuid)) {
				$tbl_korduk_akta_pernikahan_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_form_uuid . '/' . $tbl_korduk_akta_pernikahan_form_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_akta_pernikahan_form_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ktp_suami_uuid)) {
				$tbl_korduk_akta_pernikahan_ktp_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ktp_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ktp_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_ktp_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_suami'] = $tbl_korduk_akta_pernikahan_ktp_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ktp_istri_uuid)) {
				$tbl_korduk_akta_pernikahan_ktp_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ktp_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ktp_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_ktp_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ktp_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_istri'] = $tbl_korduk_akta_pernikahan_ktp_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid)) {
				$tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_suami'] = $tbl_korduk_akta_pernikahan_akta_kelahiran_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid)) {
				$tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_kelahiran_istri'] = $tbl_korduk_akta_pernikahan_akta_kelahiran_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ijazah_suami_uuid)) {
				$tbl_korduk_akta_pernikahan_ijazah_suami_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ijazah_suami_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ijazah_suami_uuid . '/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_suami'] = $tbl_korduk_akta_pernikahan_ijazah_suami_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_ijazah_istri_uuid)) {
				$tbl_korduk_akta_pernikahan_ijazah_istri_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_ijazah_istri_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_ijazah_istri_uuid . '/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ijazah_istri'] = $tbl_korduk_akta_pernikahan_ijazah_istri_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_pas_foto_uuid)) {
				$tbl_korduk_akta_pernikahan_pas_foto_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_pas_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_pas_foto_uuid . '/' . $tbl_korduk_akta_pernikahan_pas_foto_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_pas_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_pas_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['pas_foto'] = $tbl_korduk_akta_pernikahan_pas_foto_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_suket_pernikahan_uuid)) {
				$tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_uuid . '/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_pernikahan'] = $tbl_korduk_akta_pernikahan_suket_pernikahan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_suket_desa_uuid)) {
				$tbl_korduk_akta_pernikahan_suket_desa_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_suket_desa_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_suket_desa_uuid . '/' . $tbl_korduk_akta_pernikahan_suket_desa_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_desa_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_suket_desa_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_desa'] = $tbl_korduk_akta_pernikahan_suket_desa_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_kk_uuid)) {
				$tbl_korduk_akta_pernikahan_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_kk_uuid . '/' . $tbl_korduk_akta_pernikahan_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_pernikahan_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_pernikahan_form2_uuid)) {
				$tbl_korduk_akta_pernikahan_form2_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_pernikahan_form2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_pernikahan_form2_uuid . '/' . $tbl_korduk_akta_pernikahan_form2_name, 
						FCPATH . 'uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan_form2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form2'] = $tbl_korduk_akta_pernikahan_form2_name_copy;
			}
		
			
			$save_tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->change($id, $save_data);

			if ($save_tbl_korduk_akta_pernikahan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_akta_pernikahan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_pernikahan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_pernikahan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Pernikahans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_akta_pernikahan'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_akta_pernikahan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Akta Pernikahans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_view');

		$this->data['tbl_korduk_akta_pernikahan'] = $this->model_tbl_korduk_akta_pernikahan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Akta Pernikahan Detail');
		$this->render('modul/tbl_korduk_akta_pernikahan/tbl_korduk_akta_pernikahan_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Pernikahans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		if (!empty($tbl_korduk_akta_pernikahan->form)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->form;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->ktp_suami)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->ktp_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->ktp_istri)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->ktp_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->akta_kelahiran_suami)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->akta_kelahiran_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->akta_kelahiran_istri)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->akta_kelahiran_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->ijazah_suami)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->ijazah_suami;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->ijazah_istri)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->ijazah_istri;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->pas_foto)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->pas_foto;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->suket_pernikahan)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->suket_pernikahan;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->suket_desa)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->suket_desa;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->kk)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_pernikahan->form2)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_pernikahan/' . $tbl_korduk_akta_pernikahan->form2;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_akta_pernikahan->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_form_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_form_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_form_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_form_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_ktp_suami_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_ktp_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_ktp_suami_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_suami', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_ktp_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_ktp_istri_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_ktp_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_ktp_istri_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_istri', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_ktp_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_akta_kelahiran_suami_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_akta_kelahiran_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_akta_kelahiran_suami_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_kelahiran_suami', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_akta_kelahiran_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_akta_kelahiran_istri_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_akta_kelahiran_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_akta_kelahiran_istri_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_kelahiran_istri', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_akta_kelahiran_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_ijazah_suami_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_ijazah_suami_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_ijazah_suami_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ijazah_suami', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_ijazah_suami_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_ijazah_istri_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_ijazah_istri_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_ijazah_istri_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ijazah_istri', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_ijazah_istri_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_pas_foto_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_pas_foto_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_pas_foto_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'pas_foto', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_pas_foto_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_suket_pernikahan_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_suket_pernikahan_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_suket_pernikahan_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_pernikahan', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_suket_pernikahan_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_suket_desa_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_suket_desa_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_suket_desa_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_desa', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_suket_desa_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_kk_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function upload_form2_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_pernikahan',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function delete_form2_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'form2', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Pernikahan	* 
	* @return JSON
	*/
	public function get_form2_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_pernikahan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_pernikahan = $this->model_tbl_korduk_akta_pernikahan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form2', 
            'table_name'        => 'tbl_korduk_akta_pernikahan',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_pernikahan/',
            'delete_endpoint'   => 'tbl_korduk_akta_pernikahan/delete_form2_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_export');

		$this->model_tbl_korduk_akta_pernikahan->export('tbl_korduk_akta_pernikahan', 'tbl_korduk_akta_pernikahan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_akta_pernikahan_export');

		$this->model_tbl_korduk_akta_pernikahan->pdf('tbl_korduk_akta_pernikahan', 'tbl_korduk_akta_pernikahan');
	}
}


/* End of file tbl_korduk_akta_pernikahan.php */
/* Location: ./application/controllers/Tbl Korduk Akta Pernikahan.php */