<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Kk Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Kk site
*|
*/
class Tbl_korduk_kk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_kk');
	}

	/**
	* show all Tbl Korduk Kks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_kk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_kks'] = $this->model_tbl_korduk_kk->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_kk_counts'] = $this->model_tbl_korduk_kk->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_kk/index/',
			'total_rows'   => $this->model_tbl_korduk_kk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Kartu Keluarga List');
		$this->render('modul/tbl_korduk_kk/tbl_korduk_kk_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_kks
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_kk_add');

		$this->template->title('Adminduk Kartu Keluarga New');
		$this->render('modul/tbl_korduk_kk/tbl_korduk_kk_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Kks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[100]');
//		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
//		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('tbl_korduk_kk_form_name', 'Form', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_ktp1_name', 'KTP', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_ktp2_name', 'KTP 2', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_nikah_name', 'Surat Nikah', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_pindah_skwni_name', 'Surat Pindah SKWNI', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_pindah_alamat_name', 'Surat Pindah Alamat', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_suket_hilang_name', 'Suket Hilang', 'trim');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_kk_form_uuid = $this->input->post('tbl_korduk_kk_form_uuid');
			$tbl_korduk_kk_form_name = $this->input->post('tbl_korduk_kk_form_name');
			$tbl_korduk_kk_ktp1_uuid = $this->input->post('tbl_korduk_kk_ktp1_uuid');
			$tbl_korduk_kk_ktp1_name = $this->input->post('tbl_korduk_kk_ktp1_name');
			$tbl_korduk_kk_ktp2_uuid = $this->input->post('tbl_korduk_kk_ktp2_uuid');
			$tbl_korduk_kk_ktp2_name = $this->input->post('tbl_korduk_kk_ktp2_name');
			$tbl_korduk_kk_surat_nikah_uuid = $this->input->post('tbl_korduk_kk_surat_nikah_uuid');
			$tbl_korduk_kk_surat_nikah_name = $this->input->post('tbl_korduk_kk_surat_nikah_name');
			$tbl_korduk_kk_surat_pindah_skwni_uuid = $this->input->post('tbl_korduk_kk_surat_pindah_skwni_uuid');
			$tbl_korduk_kk_surat_pindah_skwni_name = $this->input->post('tbl_korduk_kk_surat_pindah_skwni_name');
			$tbl_korduk_kk_surat_pindah_alamat_uuid = $this->input->post('tbl_korduk_kk_surat_pindah_alamat_uuid');
			$tbl_korduk_kk_surat_pindah_alamat_name = $this->input->post('tbl_korduk_kk_surat_pindah_alamat_name');
			$tbl_korduk_kk_suket_hilang_uuid = $this->input->post('tbl_korduk_kk_suket_hilang_uuid');
			$tbl_korduk_kk_suket_hilang_name = $this->input->post('tbl_korduk_kk_suket_hilang_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_kk/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_kk/');
			}

			if (!empty($tbl_korduk_kk_form_name)) {
				$tbl_korduk_kk_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_form_uuid . '/' . $tbl_korduk_kk_form_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_kk_form_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_ktp1_name)) {
				$tbl_korduk_kk_ktp1_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_ktp1_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_ktp1_uuid . '/' . $tbl_korduk_kk_ktp1_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp1_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp1_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp1'] = $tbl_korduk_kk_ktp1_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_ktp2_name)) {
				$tbl_korduk_kk_ktp2_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_ktp2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_ktp2_uuid . '/' . $tbl_korduk_kk_ktp2_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp2'] = $tbl_korduk_kk_ktp2_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_nikah_name)) {
				$tbl_korduk_kk_surat_nikah_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_nikah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_nikah_uuid . '/' . $tbl_korduk_kk_surat_nikah_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_nikah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_nikah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_nikah'] = $tbl_korduk_kk_surat_nikah_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_pindah_skwni_name)) {
				$tbl_korduk_kk_surat_pindah_skwni_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_pindah_skwni_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_pindah_skwni_uuid . '/' . $tbl_korduk_kk_surat_pindah_skwni_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_skwni_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_skwni_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pindah_skwni'] = $tbl_korduk_kk_surat_pindah_skwni_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_pindah_alamat_name)) {
				$tbl_korduk_kk_surat_pindah_alamat_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_pindah_alamat_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_pindah_alamat_uuid . '/' . $tbl_korduk_kk_surat_pindah_alamat_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_alamat_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_alamat_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pindah_alamat'] = $tbl_korduk_kk_surat_pindah_alamat_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_suket_hilang_name)) {
				$tbl_korduk_kk_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_suket_hilang_uuid . '/' . $tbl_korduk_kk_suket_hilang_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_korduk_kk_suket_hilang_name_copy;
			}
		
			
			$save_tbl_korduk_kk = $this->model_tbl_korduk_kk->store($save_data);

			if ($save_tbl_korduk_kk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_kk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_kk/edit/' . $save_tbl_korduk_kk, 'Edit Tbl Korduk Kk'),
						anchor('tbl_korduk_kk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_kk/edit/' . $save_tbl_korduk_kk, 'Edit Tbl Korduk Kk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_kk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_kk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Kks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_kk_update');

		$this->data['tbl_korduk_kk'] = $this->model_tbl_korduk_kk->find($id);

		$this->template->title('Adminduk Kartu Keluarga Update');
		$this->render('modul/tbl_korduk_kk/tbl_korduk_kk_update', $this->data);
	}

	/**
	* Update Tbl Korduk Kks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_kk_form_name', 'Form', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_ktp1_name', 'KTP', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_ktp2_name', 'KTP 2', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_nikah_name', 'Surat Nikah', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_pindah_skwni_name', 'Surat Pindah SKWNI', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_surat_pindah_alamat_name', 'Surat Pindah Alamat', 'trim');
		$this->form_validation->set_rules('tbl_korduk_kk_suket_hilang_name', 'Suket Hilang', 'trim');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_kk_form_uuid = $this->input->post('tbl_korduk_kk_form_uuid');
			$tbl_korduk_kk_form_name = $this->input->post('tbl_korduk_kk_form_name');
			$tbl_korduk_kk_ktp1_uuid = $this->input->post('tbl_korduk_kk_ktp1_uuid');
			$tbl_korduk_kk_ktp1_name = $this->input->post('tbl_korduk_kk_ktp1_name');
			$tbl_korduk_kk_ktp2_uuid = $this->input->post('tbl_korduk_kk_ktp2_uuid');
			$tbl_korduk_kk_ktp2_name = $this->input->post('tbl_korduk_kk_ktp2_name');
			$tbl_korduk_kk_surat_nikah_uuid = $this->input->post('tbl_korduk_kk_surat_nikah_uuid');
			$tbl_korduk_kk_surat_nikah_name = $this->input->post('tbl_korduk_kk_surat_nikah_name');
			$tbl_korduk_kk_surat_pindah_skwni_uuid = $this->input->post('tbl_korduk_kk_surat_pindah_skwni_uuid');
			$tbl_korduk_kk_surat_pindah_skwni_name = $this->input->post('tbl_korduk_kk_surat_pindah_skwni_name');
			$tbl_korduk_kk_surat_pindah_alamat_uuid = $this->input->post('tbl_korduk_kk_surat_pindah_alamat_uuid');
			$tbl_korduk_kk_surat_pindah_alamat_name = $this->input->post('tbl_korduk_kk_surat_pindah_alamat_name');
			$tbl_korduk_kk_suket_hilang_uuid = $this->input->post('tbl_korduk_kk_suket_hilang_uuid');
			$tbl_korduk_kk_suket_hilang_name = $this->input->post('tbl_korduk_kk_suket_hilang_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_kk/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_kk/');
			}

			if (!empty($tbl_korduk_kk_form_uuid)) {
				$tbl_korduk_kk_form_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_form_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_form_uuid . '/' . $tbl_korduk_kk_form_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_form_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_form_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['form'] = $tbl_korduk_kk_form_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_ktp1_uuid)) {
				$tbl_korduk_kk_ktp1_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_ktp1_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_ktp1_uuid . '/' . $tbl_korduk_kk_ktp1_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp1_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp1_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp1'] = $tbl_korduk_kk_ktp1_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_ktp2_uuid)) {
				$tbl_korduk_kk_ktp2_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_ktp2_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_ktp2_uuid . '/' . $tbl_korduk_kk_ktp2_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp2_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_ktp2_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp2'] = $tbl_korduk_kk_ktp2_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_nikah_uuid)) {
				$tbl_korduk_kk_surat_nikah_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_nikah_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_nikah_uuid . '/' . $tbl_korduk_kk_surat_nikah_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_nikah_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_nikah_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_nikah'] = $tbl_korduk_kk_surat_nikah_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_pindah_skwni_uuid)) {
				$tbl_korduk_kk_surat_pindah_skwni_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_pindah_skwni_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_pindah_skwni_uuid . '/' . $tbl_korduk_kk_surat_pindah_skwni_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_skwni_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_skwni_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pindah_skwni'] = $tbl_korduk_kk_surat_pindah_skwni_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_surat_pindah_alamat_uuid)) {
				$tbl_korduk_kk_surat_pindah_alamat_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_surat_pindah_alamat_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_surat_pindah_alamat_uuid . '/' . $tbl_korduk_kk_surat_pindah_alamat_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_alamat_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_surat_pindah_alamat_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pindah_alamat'] = $tbl_korduk_kk_surat_pindah_alamat_name_copy;
			}
		
			if (!empty($tbl_korduk_kk_suket_hilang_uuid)) {
				$tbl_korduk_kk_suket_hilang_name_copy = date('YmdHis') . '-' . $tbl_korduk_kk_suket_hilang_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_kk_suket_hilang_uuid . '/' . $tbl_korduk_kk_suket_hilang_name, 
						FCPATH . 'uploads/tbl_korduk_kk/' . $tbl_korduk_kk_suket_hilang_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk_suket_hilang_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['suket_hilang'] = $tbl_korduk_kk_suket_hilang_name_copy;
			}
		
			
			$save_tbl_korduk_kk = $this->model_tbl_korduk_kk->change($id, $save_data);

			if ($save_tbl_korduk_kk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_kk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_kk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_kk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Kks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_kk_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_kk'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_kk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Kks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_kk_view');

		$this->data['tbl_korduk_kk'] = $this->model_tbl_korduk_kk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Kartu Keluarga Detail');
		$this->render('modul/tbl_korduk_kk/tbl_korduk_kk_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Kks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		if (!empty($tbl_korduk_kk->form)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->form;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->ktp1)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->ktp1;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->ktp2)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->ktp2;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->surat_nikah)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->surat_nikah;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->surat_pindah_skwni)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->surat_pindah_skwni;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->surat_pindah_alamat)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->surat_pindah_alamat;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_kk->suket_hilang)) {
			$path = FCPATH . '/uploads/tbl_korduk_kk/' . $tbl_korduk_kk->suket_hilang;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_kk->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_form_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 500,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_form_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
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
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_form_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'form', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_form_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_ktp1_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_ktp1_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
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
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_ktp1_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp1', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_ktp1_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_ktp2_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_ktp2_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
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
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_ktp2_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp2', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_ktp2_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_surat_nikah_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_surat_nikah_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
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
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_surat_nikah_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_nikah', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_surat_nikah_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_surat_pindah_skwni_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_surat_pindah_skwni_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'surat_pindah_skwni', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_surat_pindah_skwni_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_pindah_skwni', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_surat_pindah_skwni_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_surat_pindah_alamat_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_surat_pindah_alamat_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'surat_pindah_alamat', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_surat_pindah_alamat_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_pindah_alamat', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_surat_pindah_alamat_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function upload_suket_hilang_file()
	{
		if (!$this->is_allowed('tbl_korduk_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_kk',
			'allowed_types' => 'jpg|png|pdf|jpeg',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function delete_suket_hilang_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_kk_delete', false)) {
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
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Kk	* 
	* @return JSON
	*/
	public function get_suket_hilang_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_kk = $this->model_tbl_korduk_kk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'suket_hilang', 
            'table_name'        => 'tbl_korduk_kk',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_kk/',
            'delete_endpoint'   => 'tbl_korduk_kk/delete_suket_hilang_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_kk_export');

		$this->model_tbl_korduk_kk->export('tbl_korduk_kk', 'tbl_korduk_kk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_kk_export');

		$this->model_tbl_korduk_kk->pdf('tbl_korduk_kk', 'tbl_korduk_kk');
	}
}


/* End of file tbl_korduk_kk.php */
/* Location: ./application/controllers/Tbl Korduk Kk.php */