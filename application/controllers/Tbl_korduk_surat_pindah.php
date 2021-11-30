<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Korduk Surat Pindah Controller
*| --------------------------------------------------------------------------
*| Tbl Korduk Surat Pindah site
*|
*/
class Tbl_korduk_surat_pindah extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_korduk_surat_pindah');
	}

	/**
	* show all Tbl Korduk Surat Pindahs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_korduk_surat_pindah_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_korduk_surat_pindahs'] = $this->model_tbl_korduk_surat_pindah->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_korduk_surat_pindah_counts'] = $this->model_tbl_korduk_surat_pindah->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_korduk_surat_pindah/index/',
			'total_rows'   => $this->model_tbl_korduk_surat_pindah->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Adminduk Surat Pindah List');
		$this->render('modul/tbl_korduk_surat_pindah/tbl_korduk_surat_pindah_list', $this->data);
	}
	
	/**
	* Add new tbl_korduk_surat_pindahs
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_korduk_surat_pindah_add');

		$this->template->title('Adminduk Surat Pindah New');
		$this->render('modul/tbl_korduk_surat_pindah/tbl_korduk_surat_pindah_add', $this->data);
	}

	/**
	* Add New Tbl Korduk Surat Pindahs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_add', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_surat_pengantar_name', 'Surat Pengantar', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_ktp_name', 'KTP', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_kk_name', 'KK', 'trim|required');
		

		if ($this->form_validation->run()) {
			$tbl_korduk_surat_pindah_surat_pengantar_uuid = $this->input->post('tbl_korduk_surat_pindah_surat_pengantar_uuid');
			$tbl_korduk_surat_pindah_surat_pengantar_name = $this->input->post('tbl_korduk_surat_pindah_surat_pengantar_name');
			$tbl_korduk_surat_pindah_ktp_uuid = $this->input->post('tbl_korduk_surat_pindah_ktp_uuid');
			$tbl_korduk_surat_pindah_ktp_name = $this->input->post('tbl_korduk_surat_pindah_ktp_name');
			$tbl_korduk_surat_pindah_kk_uuid = $this->input->post('tbl_korduk_surat_pindah_kk_uuid');
			$tbl_korduk_surat_pindah_kk_name = $this->input->post('tbl_korduk_surat_pindah_kk_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_surat_pindah/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_surat_pindah/');
			}

			if (!empty($tbl_korduk_surat_pindah_surat_pengantar_name)) {
				$tbl_korduk_surat_pindah_surat_pengantar_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_surat_pengantar_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_surat_pengantar_uuid . '/' . $tbl_korduk_surat_pindah_surat_pengantar_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_surat_pengantar_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_surat_pengantar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pengantar'] = $tbl_korduk_surat_pindah_surat_pengantar_name_copy;
			}
		
			if (!empty($tbl_korduk_surat_pindah_ktp_name)) {
				$tbl_korduk_surat_pindah_ktp_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_ktp_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_ktp_uuid . '/' . $tbl_korduk_surat_pindah_ktp_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_ktp_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_ktp_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp'] = $tbl_korduk_surat_pindah_ktp_name_copy;
			}
		
			if (!empty($tbl_korduk_surat_pindah_kk_name)) {
				$tbl_korduk_surat_pindah_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_kk_uuid . '/' . $tbl_korduk_surat_pindah_kk_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_surat_pindah_kk_name_copy;
			}
		
			
			$save_tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->store($save_data);

			if ($save_tbl_korduk_surat_pindah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_korduk_surat_pindah;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_korduk_surat_pindah/edit/' . $save_tbl_korduk_surat_pindah, 'Edit Tbl Korduk Surat Pindah'),
						anchor('tbl_korduk_surat_pindah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_korduk_surat_pindah/edit/' . $save_tbl_korduk_surat_pindah, 'Edit Tbl Korduk Surat Pindah')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_surat_pindah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_surat_pindah');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Korduk Surat Pindahs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_korduk_surat_pindah_update');

		$this->data['tbl_korduk_surat_pindah'] = $this->model_tbl_korduk_surat_pindah->find($id);

		$this->template->title('Adminduk Surat Pindah Update');
		$this->render('modul/tbl_korduk_surat_pindah/tbl_korduk_surat_pindah_update', $this->data);
	}

	/**
	* Update Tbl Korduk Surat Pindahs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_update', false)) {
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
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_surat_pengantar_name', 'Surat Pengantar', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_ktp_name', 'KTP', 'trim|required');
		$this->form_validation->set_rules('tbl_korduk_surat_pindah_kk_name', 'KK', 'trim|required');
		
		if ($this->form_validation->run()) {
			$tbl_korduk_surat_pindah_surat_pengantar_uuid = $this->input->post('tbl_korduk_surat_pindah_surat_pengantar_uuid');
			$tbl_korduk_surat_pindah_surat_pengantar_name = $this->input->post('tbl_korduk_surat_pindah_surat_pengantar_name');
			$tbl_korduk_surat_pindah_ktp_uuid = $this->input->post('tbl_korduk_surat_pindah_ktp_uuid');
			$tbl_korduk_surat_pindah_ktp_name = $this->input->post('tbl_korduk_surat_pindah_ktp_name');
			$tbl_korduk_surat_pindah_kk_uuid = $this->input->post('tbl_korduk_surat_pindah_kk_uuid');
			$tbl_korduk_surat_pindah_kk_name = $this->input->post('tbl_korduk_surat_pindah_kk_name');
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_korduk_surat_pindah/')) {
				mkdir(FCPATH . '/uploads/tbl_korduk_surat_pindah/');
			}

			if (!empty($tbl_korduk_surat_pindah_surat_pengantar_uuid)) {
				$tbl_korduk_surat_pindah_surat_pengantar_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_surat_pengantar_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_surat_pengantar_uuid . '/' . $tbl_korduk_surat_pindah_surat_pengantar_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_surat_pengantar_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_surat_pengantar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_pengantar'] = $tbl_korduk_surat_pindah_surat_pengantar_name_copy;
			}
		
			if (!empty($tbl_korduk_surat_pindah_ktp_uuid)) {
				$tbl_korduk_surat_pindah_ktp_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_ktp_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_ktp_uuid . '/' . $tbl_korduk_surat_pindah_ktp_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_ktp_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_ktp_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['ktp'] = $tbl_korduk_surat_pindah_ktp_name_copy;
			}
		
			if (!empty($tbl_korduk_surat_pindah_kk_uuid)) {
				$tbl_korduk_surat_pindah_kk_name_copy = date('YmdHis') . '-' . $tbl_korduk_surat_pindah_kk_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_korduk_surat_pindah_kk_uuid . '/' . $tbl_korduk_surat_pindah_kk_name, 
						FCPATH . 'uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_kk_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah_kk_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['kk'] = $tbl_korduk_surat_pindah_kk_name_copy;
			}
		
			
			$save_tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->change($id, $save_data);

			if ($save_tbl_korduk_surat_pindah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_korduk_surat_pindah', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_korduk_surat_pindah');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_korduk_surat_pindah');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Korduk Surat Pindahs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_korduk_surat_pindah_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_korduk_surat_pindah'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_korduk_surat_pindah'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Korduk Surat Pindahs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_korduk_surat_pindah_view');

		$this->data['tbl_korduk_surat_pindah'] = $this->model_tbl_korduk_surat_pindah->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Adminduk Surat Pindah Detail');
		$this->render('modul/tbl_korduk_surat_pindah/tbl_korduk_surat_pindah_view', $this->data);
	}
	
	/**
	* delete Tbl Korduk Surat Pindahs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->find($id);

		if (!empty($tbl_korduk_surat_pindah->surat_pengantar)) {
			$path = FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah->surat_pengantar;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_surat_pindah->ktp)) {
			$path = FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah->ktp;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($tbl_korduk_surat_pindah->kk)) {
			$path = FCPATH . '/uploads/tbl_korduk_surat_pindah/' . $tbl_korduk_surat_pindah->kk;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_korduk_surat_pindah->remove($id);
	}
	
	/**
	* Upload Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function upload_surat_pengantar_file()
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_surat_pindah',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function delete_surat_pengantar_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_delete', false)) {
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
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function get_surat_pengantar_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_pengantar', 
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/',
            'delete_endpoint'   => 'tbl_korduk_surat_pindah/delete_surat_pengantar_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function upload_ktp_file()
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_surat_pindah',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function delete_ktp_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_delete', false)) {
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
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function get_ktp_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'ktp', 
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/',
            'delete_endpoint'   => 'tbl_korduk_surat_pindah/delete_ktp_file'
        ]);
	}
	
	/**
	* Upload Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function upload_kk_file()
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_korduk_surat_pindah',
			'allowed_types' => 'jpg|png|pdf',
			'max_size' 	 	=> 300,
		]);
	}

	/**
	* Delete Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function delete_kk_file($uuid)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_delete', false)) {
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
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/'
        ]);
	}

	/**
	* Get Image Tbl Korduk Surat Pindah	* 
	* @return JSON
	*/
	public function get_kk_file($id)
	{
		if (!$this->is_allowed('tbl_korduk_surat_pindah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_korduk_surat_pindah = $this->model_tbl_korduk_surat_pindah->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'kk', 
            'table_name'        => 'tbl_korduk_surat_pindah',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_korduk_surat_pindah/',
            'delete_endpoint'   => 'tbl_korduk_surat_pindah/delete_kk_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_korduk_surat_pindah_export');

		$this->model_tbl_korduk_surat_pindah->export('tbl_korduk_surat_pindah', 'tbl_korduk_surat_pindah');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_korduk_surat_pindah_export');

		$this->model_tbl_korduk_surat_pindah->pdf('tbl_korduk_surat_pindah', 'tbl_korduk_surat_pindah');
	}
}


/* End of file tbl_korduk_surat_pindah.php */
/* Location: ./application/controllers/Tbl Korduk Surat Pindah.php */