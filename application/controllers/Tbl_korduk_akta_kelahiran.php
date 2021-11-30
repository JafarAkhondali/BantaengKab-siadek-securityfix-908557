<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Kelahiran Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Akta Kelahiran site
*|
*/
class Tbl_korduk_akta_kelahiran extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_akta_kelahiran');
	}

	/**
	* show all Tbl Korduk Akta Kelahirans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_akta_kelahirans'] = $this->model_tbl_korduk_akta_kelahiran->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_akta_kelahiran_counts'] = $this->model_tbl_korduk_akta_kelahiran->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_akta_kelahiran/index/',
			'total_rows'   => $this->model_tbl_korduk_akta_kelahiran->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Akta Kelahiran List');
		$this->render('modul/tbl_korduk_akta_kelahiran/tbl_korduk_akta_kelahiran_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_akta_kelahirans
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_add');

		$this->template->title('Adminduk Akta Kelahiran New');
		$this->render('modul/tbl_korduk_akta_kelahiran/tbl_korduk_akta_kelahiran_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Akta Kelahirans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('no_kk', 'No KK', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kepala_keluarga', 'Kepala Keluarga', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_form_f228_name', 'Form F-2.28', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_ktp_ayah_name', 'KTP Ayah', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_ktp_ibu_name', 'KTP Ibu', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_akta_pernikahan_name', 'Akta Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_form_f201_name', 'Form F-2.01', 'trim|required');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_akta_kelahiran_form_f228_uuid = $this->input->post('tbl_korduk_akta_kelahiran_form_f228_uuid');
			$tbl_korduk_akta_kelahiran_form_f228_name = $this->input->post('tbl_korduk_akta_kelahiran_form_f228_name');
			$tbl_korduk_akta_kelahiran_kk_uuid = $this->input->post('tbl_korduk_akta_kelahiran_kk_uuid');
			$tbl_korduk_akta_kelahiran_kk_name = $this->input->post('tbl_korduk_akta_kelahiran_kk_name');
			$tbl_korduk_akta_kelahiran_ktp_ayah_uuid = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ayah_uuid');
			$tbl_korduk_akta_kelahiran_ktp_ayah_name = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ayah_name');
			$tbl_korduk_akta_kelahiran_ktp_ibu_uuid = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ibu_uuid');
			$tbl_korduk_akta_kelahiran_ktp_ibu_name = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ibu_name');
			$tbl_korduk_akta_kelahiran_akta_pernikahan_uuid = $this->input->post('tbl_korduk_akta_kelahiran_akta_pernikahan_uuid');
			$tbl_korduk_akta_kelahiran_akta_pernikahan_name = $this->input->post('tbl_korduk_akta_kelahiran_akta_pernikahan_name');
			$tbl_korduk_akta_kelahiran_form_f201_uuid = $this->input->post('tbl_korduk_akta_kelahiran_form_f201_uuid');
			$tbl_korduk_akta_kelahiran_form_f201_name = $this->input->post('tbl_korduk_akta_kelahiran_form_f201_name');
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'kepala_keluarga' => $this->input->post('kepala_keluarga'),
				'alamat' => $this->input->post('alamat'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/');
			}

			if (!empty($tbl_korduk_akta_kelahiran_form_f228_name)) {
				$tbl_korduk_akta_kelahiran_form_f228_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_form_f228_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_form_f228_uuid . '/' . $tbl_korduk_akta_kelahiran_form_f228_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f228_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f228_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f228'] = $tbl_korduk_akta_kelahiran_form_f228_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_kk_name)) {
				$tbl_korduk_akta_kelahiran_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_kk_uuid . '/' . $tbl_korduk_akta_kelahiran_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_kelahiran_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_ktp_ayah_name)) {
				$tbl_korduk_akta_kelahiran_ktp_ayah_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_ktp_ayah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_ktp_ayah_uuid . '/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_ayah'] = $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_ktp_ibu_name)) {
				$tbl_korduk_akta_kelahiran_ktp_ibu_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_ktp_ibu_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_ktp_ibu_uuid . '/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_ibu'] = $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_akta_pernikahan_name)) {
				$tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_uuid . '/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_pernikahan'] = $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_form_f201_name)) {
				$tbl_korduk_akta_kelahiran_form_f201_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_form_f201_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_form_f201_uuid . '/' . $tbl_korduk_akta_kelahiran_form_f201_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f201_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f201_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f201'] = $tbl_korduk_akta_kelahiran_form_f201_name_copy;
			}
		
			
			$save_tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->store($save_data);

			if ($save_tbl_korduk_akta_kelahiran) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_akta_kelahiran;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_akta_kelahiran/edit/' . $save_tbl_korduk_akta_kelahiran, 'Edit Tbl Korduk Akta Kelahiran'),
						anchor('tbl_korduk_akta_kelahiran', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_akta_kelahiran/edit/' . $save_tbl_korduk_akta_kelahiran, 'Edit Tbl Korduk Akta Kelahiran')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_kelahiran');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_kelahiran');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Akta Kelahirans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_update');

		$this->data['tbl_korduk_akta_kelahiran'] = $this->model_tbl_korduk_akta_kelahiran->find($id);

		$this->template->title('Adminduk Akta Kelahiran Update');
		$this->render('modul/tbl_korduk_akta_kelahiran/tbl_korduk_akta_kelahiran_update', $this->data);
	}

	/**
	* Update Tbl Korduk Akta Kelahirans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no_kk', 'No KK', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kepala_keluarga', 'Kepala Keluarga', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_form_f228_name', 'Form F-2.28', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_kk_name', 'KK', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_ktp_ayah_name', 'KTP Ayah', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_ktp_ibu_name', 'KTP Ibu', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_akta_pernikahan_name', 'Akta Pernikahan', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_akta_kelahiran_form_f201_name', 'Form F-2.01', 'trim|required');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_akta_kelahiran_form_f228_uuid = $this->input->post('tbl_korduk_akta_kelahiran_form_f228_uuid');
			$tbl_korduk_akta_kelahiran_form_f228_name = $this->input->post('tbl_korduk_akta_kelahiran_form_f228_name');
			$tbl_korduk_akta_kelahiran_kk_uuid = $this->input->post('tbl_korduk_akta_kelahiran_kk_uuid');
			$tbl_korduk_akta_kelahiran_kk_name = $this->input->post('tbl_korduk_akta_kelahiran_kk_name');
			$tbl_korduk_akta_kelahiran_ktp_ayah_uuid = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ayah_uuid');
			$tbl_korduk_akta_kelahiran_ktp_ayah_name = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ayah_name');
			$tbl_korduk_akta_kelahiran_ktp_ibu_uuid = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ibu_uuid');
			$tbl_korduk_akta_kelahiran_ktp_ibu_name = $this->input->post('tbl_korduk_akta_kelahiran_ktp_ibu_name');
			$tbl_korduk_akta_kelahiran_akta_pernikahan_uuid = $this->input->post('tbl_korduk_akta_kelahiran_akta_pernikahan_uuid');
			$tbl_korduk_akta_kelahiran_akta_pernikahan_name = $this->input->post('tbl_korduk_akta_kelahiran_akta_pernikahan_name');
			$tbl_korduk_akta_kelahiran_form_f201_uuid = $this->input->post('tbl_korduk_akta_kelahiran_form_f201_uuid');
			$tbl_korduk_akta_kelahiran_form_f201_name = $this->input->post('tbl_korduk_akta_kelahiran_form_f201_name');
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'kepala_keluarga' => $this->input->post('kepala_keluarga'),
				'alamat' => $this->input->post('alamat'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/');
			}

			if (!empty($tbl_korduk_akta_kelahiran_form_f228_uuid)) {
				$tbl_korduk_akta_kelahiran_form_f228_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_form_f228_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_form_f228_uuid . '/' . $tbl_korduk_akta_kelahiran_form_f228_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f228_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f228_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f228'] = $tbl_korduk_akta_kelahiran_form_f228_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_kk_uuid)) {
				$tbl_korduk_akta_kelahiran_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_kk_uuid . '/' . $tbl_korduk_akta_kelahiran_kk_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_akta_kelahiran_kk_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_ktp_ayah_uuid)) {
				$tbl_korduk_akta_kelahiran_ktp_ayah_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_ktp_ayah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_ktp_ayah_uuid . '/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_ayah'] = $tbl_korduk_akta_kelahiran_ktp_ayah_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_ktp_ibu_uuid)) {
				$tbl_korduk_akta_kelahiran_ktp_ibu_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_ktp_ibu_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_ktp_ibu_uuid . '/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp_ibu'] = $tbl_korduk_akta_kelahiran_ktp_ibu_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_akta_pernikahan_uuid)) {
				$tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_uuid . '/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['akta_pernikahan'] = $tbl_korduk_akta_kelahiran_akta_pernikahan_name_copy;
			}
		
			if (!empty($tbl_korduk_akta_kelahiran_form_f201_uuid)) {
				$tbl_korduk_akta_kelahiran_form_f201_name_copy = date('YmdHis') . '-' . $tbl_korduk_akta_kelahiran_form_f201_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_akta_kelahiran_form_f201_uuid . '/' . $tbl_korduk_akta_kelahiran_form_f201_name, 
						FCPATH . 'uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f201_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran_form_f201_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form_f201'] = $tbl_korduk_akta_kelahiran_form_f201_name_copy;
			}
		
			
			$save_tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->change($id, $save_data);

			if ($save_tbl_korduk_akta_kelahiran) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_akta_kelahiran', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_akta_kelahiran');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_akta_kelahiran');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Kelahirans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_akta_kelahiran'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_akta_kelahiran'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Akta Kelahirans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_view');

		$this->data['tbl_korduk_akta_kelahiran'] = $this->model_tbl_korduk_akta_kelahiran->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Akta Kelahiran Detail');
		$this->render('modul/tbl_korduk_akta_kelahiran/tbl_korduk_akta_kelahiran_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Akta Kelahirans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		if (!empty($tbl_korduk_akta_kelahiran->form_f228)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->form_f228;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kelahiran->kk)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kelahiran->ktp_ayah)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->ktp_ayah;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kelahiran->ktp_ibu)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->ktp_ibu;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kelahiran->akta_pernikahan)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->akta_pernikahan;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_akta_kelahiran->form_f201)) {
			$path = FCPATH . '/uploads/tbl_korduk_akta_kelahiran/' . $tbl_korduk_akta_kelahiran->form_f201;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_akta_kelahiran->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_form_f228_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_form_f228_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'form_f228', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_form_f228_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form_f228', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_form_f228_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_kk_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_ktp_ayah_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_ktp_ayah_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp_ayah', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_ktp_ayah_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_ayah', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_ktp_ayah_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_ktp_ibu_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_ktp_ibu_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'ktp_ibu', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_ktp_ibu_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp_ibu', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_ktp_ibu_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_akta_pernikahan_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_akta_pernikahan_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
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
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_akta_pernikahan_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'akta_pernikahan', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_akta_pernikahan_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function upload_form_f201_file()
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_akta_kelahiran',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function delete_form_f201_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'form_f201', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Akta Kelahiran	* 
	* @return JSON
	*/
	public function get_form_f201_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_akta_kelahiran_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_akta_kelahiran = $this->model_tbl_korduk_akta_kelahiran->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form_f201', 
            'table_name'        => 'tbl_korduk_akta_kelahiran',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_akta_kelahiran/',
            'delete_endpoint'   => 'tbl_korduk_akta_kelahiran/delete_form_f201_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_export');

		$this->model_tbl_korduk_akta_kelahiran->export('tbl_korduk_akta_kelahiran', 'tbl_korduk_akta_kelahiran');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_akta_kelahiran_export');

		$this->model_tbl_korduk_akta_kelahiran->pdf('tbl_korduk_akta_kelahiran', 'tbl_korduk_akta_kelahiran');
	}
}


/* End of file tbl_korduk_akta_kelahiran.php */
/* Location: ./application/controllers/Tbl Korduk Akta Kelahiran.php */