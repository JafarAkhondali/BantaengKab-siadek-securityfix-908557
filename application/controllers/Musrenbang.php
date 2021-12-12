<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Musrenbang Controller
*| --------------------------------------------------------------------------
*| Musrenbang site
*|
*/
class Musrenbang extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_musrenbang');
	}

	/**
	* show all Musrenbangs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('musrenbang_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['musrenbangs'] = $this->model_musrenbang->get($filter, $field, $this->limit_page, $offset);
		$this->data['musrenbang_counts'] = $this->model_musrenbang->count_all($filter, $field);

		$config = [
			'base_url'     => 'musrenbang/index/',
			'total_rows'   => $this->model_musrenbang->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Musrenbang List');
		$this->render('modul/musrenbang/musrenbang_list', $this->data);
	}
	
	/**
	* Add new musrenbangs
	*
	*/
	public function add()
	{
		$this->is_allowed('musrenbang_add');

		$this->template->title('Musrenbang New');
		$this->render('modul/musrenbang/musrenbang_add', $this->data);
	}

	/**
	* Add New Musrenbangs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('musrenbang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('kegitan', 'Kegitan', 'trim|required');
		$this->form_validation->set_rules('Lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('Biaya', 'Biaya', 'trim|required');
		$this->form_validation->set_rules('total', 'Total', 'trim|required');
		$this->form_validation->set_rules('ket_usulan', 'Ket Usulan', 'trim|required');
		$this->form_validation->set_rules('satatus_program', 'Satatus Program', 'trim|required');
		

		if ($this->form_validation->run()) {
			$musrenbang_berita_acara_uuid = $this->input->post('musrenbang_berita_acara_uuid');
			$musrenbang_berita_acara_name = $this->input->post('musrenbang_berita_acara_name');
			$musrenbang_daftar_hadir_uuid = $this->input->post('musrenbang_daftar_hadir_uuid');
			$musrenbang_daftar_hadir_name = $this->input->post('musrenbang_daftar_hadir_name');
			$musrenbang_notulensi_rapat_uuid = $this->input->post('musrenbang_notulensi_rapat_uuid');
			$musrenbang_notulensi_rapat_name = $this->input->post('musrenbang_notulensi_rapat_name');
		
			$save_data = [
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'kd_rekening' => $this->input->post('kd_rekening'),
				'kegitan' => $this->input->post('kegitan'),
				'Lokasi' => $this->input->post('Lokasi'),
				'Biaya' => $this->input->post('Biaya'),
				'total' => $this->input->post('total'),
				'ket_usulan' => $this->input->post('ket_usulan'),
				'satatus_program' => $this->input->post('satatus_program'),
				'Tahun' => $this->input->post('Tahun'),
				'user_masuk' => get_user_data('username'),
				'tanggal_masuk' => date('Y-m-d H:i:s'),
				'user_update' => get_user_data('username'),
			];

			if (!is_dir(FCPATH . '/uploads/musrenbang/')) {
				mkdir(FCPATH . '/uploads/musrenbang/');
			}

			if (!empty($musrenbang_berita_acara_name)) {
				$musrenbang_berita_acara_name_copy = date('YmdHis') . '-' . $musrenbang_berita_acara_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_berita_acara_uuid . '/' . $musrenbang_berita_acara_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_berita_acara_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_berita_acara_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['berita_acara'] = $musrenbang_berita_acara_name_copy;
			}
		
			if (!empty($musrenbang_daftar_hadir_name)) {
				$musrenbang_daftar_hadir_name_copy = date('YmdHis') . '-' . $musrenbang_daftar_hadir_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_daftar_hadir_uuid . '/' . $musrenbang_daftar_hadir_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_daftar_hadir_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_daftar_hadir_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['daftar_hadir'] = $musrenbang_daftar_hadir_name_copy;
			}
		
			if (!empty($musrenbang_notulensi_rapat_name)) {
				$musrenbang_notulensi_rapat_name_copy = date('YmdHis') . '-' . $musrenbang_notulensi_rapat_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_notulensi_rapat_uuid . '/' . $musrenbang_notulensi_rapat_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_notulensi_rapat_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_notulensi_rapat_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['notulensi_rapat'] = $musrenbang_notulensi_rapat_name_copy;
			}
		
			
			$save_musrenbang = $this->model_musrenbang->store($save_data);

			if ($save_musrenbang) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_musrenbang;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('musrenbang/edit/' . $save_musrenbang, 'Edit Musrenbang'),
						anchor('musrenbang', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('musrenbang/edit/' . $save_musrenbang, 'Edit Musrenbang')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('musrenbang');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('musrenbang');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Musrenbangs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('musrenbang_update');

		$this->data['musrenbang'] = $this->model_musrenbang->find($id);

		$this->template->title('Musrenbang Update');
		$this->render('modul/musrenbang/musrenbang_update', $this->data);
	}

	/**
	* Update Musrenbangs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('musrenbang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kegitan', 'Kegitan', 'trim|required');
		$this->form_validation->set_rules('Lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('Biaya', 'Biaya', 'trim|required');
		$this->form_validation->set_rules('total', 'Total', 'trim|required');
		$this->form_validation->set_rules('ket_usulan', 'Ket Usulan', 'trim|required');
		$this->form_validation->set_rules('satatus_program', 'Satatus Program', 'trim|required');
		
		if ($this->form_validation->run()) {
			$musrenbang_berita_acara_uuid = $this->input->post('musrenbang_berita_acara_uuid');
			$musrenbang_berita_acara_name = $this->input->post('musrenbang_berita_acara_name');
			$musrenbang_daftar_hadir_uuid = $this->input->post('musrenbang_daftar_hadir_uuid');
			$musrenbang_daftar_hadir_name = $this->input->post('musrenbang_daftar_hadir_name');
			$musrenbang_notulensi_rapat_uuid = $this->input->post('musrenbang_notulensi_rapat_uuid');
			$musrenbang_notulensi_rapat_name = $this->input->post('musrenbang_notulensi_rapat_name');
		
			$save_data = [
				
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'kd_rekening' => $this->input->post('kd_rekening'),
				'kegitan' => $this->input->post('kegitan'),
				'Lokasi' => $this->input->post('Lokasi'),
				'Biaya' => $this->input->post('Biaya'),
				'total' => $this->input->post('total'),
				'ket_usulan' => $this->input->post('ket_usulan'),
				'satatus_program' => $this->input->post('satatus_program'),
				'Tahun' => $this->input->post('Tahun'),
				'user_masuk' => get_user_data('username'),
				'user_update' => get_user_data('username'),
				'tanggal_update' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/musrenbang/')) {
				mkdir(FCPATH . '/uploads/musrenbang/');
			}

			if (!empty($musrenbang_berita_acara_uuid)) {
				$musrenbang_berita_acara_name_copy = date('YmdHis') . '-' . $musrenbang_berita_acara_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_berita_acara_uuid . '/' . $musrenbang_berita_acara_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_berita_acara_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_berita_acara_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['berita_acara'] = $musrenbang_berita_acara_name_copy;
			}
		
			if (!empty($musrenbang_daftar_hadir_uuid)) {
				$musrenbang_daftar_hadir_name_copy = date('YmdHis') . '-' . $musrenbang_daftar_hadir_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_daftar_hadir_uuid . '/' . $musrenbang_daftar_hadir_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_daftar_hadir_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_daftar_hadir_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['daftar_hadir'] = $musrenbang_daftar_hadir_name_copy;
			}
		
			if (!empty($musrenbang_notulensi_rapat_uuid)) {
				$musrenbang_notulensi_rapat_name_copy = date('YmdHis') . '-' . $musrenbang_notulensi_rapat_name;

				rename(FCPATH . 'uploads/tmp/' . $musrenbang_notulensi_rapat_uuid . '/' . $musrenbang_notulensi_rapat_name, 
						FCPATH . 'uploads/musrenbang/' . $musrenbang_notulensi_rapat_name_copy);

				if (!is_file(FCPATH . '/uploads/musrenbang/' . $musrenbang_notulensi_rapat_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['notulensi_rapat'] = $musrenbang_notulensi_rapat_name_copy;
			}
		
			
			$save_musrenbang = $this->model_musrenbang->change($id, $save_data);

			if ($save_musrenbang) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('musrenbang', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('musrenbang');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('musrenbang');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Musrenbangs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('musrenbang_delete');

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
            set_message(cclang('has_been_deleted', 'musrenbang'), 'success');
        } else {
            set_message(cclang('error_delete', 'musrenbang'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Musrenbangs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('musrenbang_view');

		$this->data['musrenbang'] = $this->model_musrenbang->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Musrenbang Detail');
		$this->render('modul/musrenbang/musrenbang_view', $this->data);
	}
	
	/**
	* delete Musrenbangs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$musrenbang = $this->model_musrenbang->find($id);

		if (!empty($musrenbang->berita_acara)) {
			$path = FCPATH . '/uploads/musrenbang/' . $musrenbang->berita_acara;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($musrenbang->daftar_hadir)) {
			$path = FCPATH . '/uploads/musrenbang/' . $musrenbang->daftar_hadir;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		if (!empty($musrenbang->notulensi_rapat)) {
			$path = FCPATH . '/uploads/musrenbang/' . $musrenbang->notulensi_rapat;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_musrenbang->remove($id);
	}
	
	/**
	* Upload Image Musrenbang	* 
	* @return JSON
	*/
	public function upload_berita_acara_file()
	{
		if (!$this->is_allowed('musrenbang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'musrenbang',
		]);
	}

	/**
	* Delete Image Musrenbang	* 
	* @return JSON
	*/
	public function delete_berita_acara_file($uuid)
	{
		if (!$this->is_allowed('musrenbang_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'berita_acara', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/'
        ]);
	}

	/**
	* Get Image Musrenbang	* 
	* @return JSON
	*/
	public function get_berita_acara_file($id)
	{
		if (!$this->is_allowed('musrenbang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$musrenbang = $this->model_musrenbang->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'berita_acara', 
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/',
            'delete_endpoint'   => 'musrenbang/delete_berita_acara_file'
        ]);
	}
	
	/**
	* Upload Image Musrenbang	* 
	* @return JSON
	*/
	public function upload_daftar_hadir_file()
	{
		if (!$this->is_allowed('musrenbang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'musrenbang',
		]);
	}

	/**
	* Delete Image Musrenbang	* 
	* @return JSON
	*/
	public function delete_daftar_hadir_file($uuid)
	{
		if (!$this->is_allowed('musrenbang_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'daftar_hadir', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/'
        ]);
	}

	/**
	* Get Image Musrenbang	* 
	* @return JSON
	*/
	public function get_daftar_hadir_file($id)
	{
		if (!$this->is_allowed('musrenbang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$musrenbang = $this->model_musrenbang->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'daftar_hadir', 
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/',
            'delete_endpoint'   => 'musrenbang/delete_daftar_hadir_file'
        ]);
	}
	
	/**
	* Upload Image Musrenbang	* 
	* @return JSON
	*/
	public function upload_notulensi_rapat_file()
	{
		if (!$this->is_allowed('musrenbang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'musrenbang',
		]);
	}

	/**
	* Delete Image Musrenbang	* 
	* @return JSON
	*/
	public function delete_notulensi_rapat_file($uuid)
	{
		if (!$this->is_allowed('musrenbang_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'notulensi_rapat', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/'
        ]);
	}

	/**
	* Get Image Musrenbang	* 
	* @return JSON
	*/
	public function get_notulensi_rapat_file($id)
	{
		if (!$this->is_allowed('musrenbang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$musrenbang = $this->model_musrenbang->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'notulensi_rapat', 
            'table_name'        => 'musrenbang',
            'primary_key'       => 'id_musrenbang',
            'upload_path'       => 'uploads/musrenbang/',
            'delete_endpoint'   => 'musrenbang/delete_notulensi_rapat_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('musrenbang_export');

		$this->model_musrenbang->export('musrenbang', 'musrenbang');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('musrenbang_export');

		$this->model_musrenbang->pdf('musrenbang', 'musrenbang');
	}
}


/* End of file musrenbang.php */
/* Location: ./application/controllers/Musrenbang.php */