<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Wilayah Kepala Controller
*| --------------------------------------------------------------------------
*| Wilayah Kepala site
*|
*/
class Wilayah_kepala extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_wilayah_kepala');
	}

	/**
	* show all Wilayah Kepalas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('wilayah_kepala_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['wilayah_kepalas'] = $this->model_wilayah_kepala->get($filter, $field, $this->limit_page, $offset);
		$this->data['wilayah_kepala_counts'] = $this->model_wilayah_kepala->count_all($filter, $field);

		$config = [
			'base_url'     => 'wilayah_kepala/index/',
			'total_rows'   => $this->model_wilayah_kepala->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kepala Desa List');

		$user=get_user_data('kd_wilayah');
		$this->db->from('wilayah_kepala');
		$this->db->where('kd_wilayah', get_user_data('kd_wilayah'));
		$exist = $this->db->get()->row();
		if (empty($exist))
           { $this->render('modul/wilayah_kepala/wilayah_kepala_blak', $this->data);}
		else if(strlen($user)==10){
		$this->render('modul/wilayah_kepala/wilayah_kepala_list', $this->data);
			}else{
				$this->render('modul/wilayah_kepala/wilayah_kepala_list', $this->data);
			}

	}
	
	/**
	* Add new wilayah_kepalas
	*
	*/
	public function add()
	{
		$this->is_allowed('wilayah_kepala_add');

		$this->template->title('Kepala Desa New');
		$this->render('modul/wilayah_kepala/wilayah_kepala_add', $this->data);
	}

	/**
	* Add New Wilayah Kepalas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('wilayah_kepala_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jabatan[]', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('usia', 'Usia', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('agama[]', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pend_terakhir[]', 'Pend Terakhir', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('periode_mulai', 'Periode Mulai', 'trim|required');
		$this->form_validation->set_rules('periode_selesai', 'Periode Selesai', 'trim|required');
		$this->form_validation->set_rules('wilayah_kepala_avatar_name', 'Avatar', 'trim');
		

		if ($this->form_validation->run()) {
			$wilayah_kepala_avatar_uuid = $this->input->post('wilayah_kepala_avatar_uuid');
			$wilayah_kepala_avatar_name = $this->input->post('wilayah_kepala_avatar_name');
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nama' => $this->input->post('nama'),
				'jabatan' => implode(',', (array) $this->input->post('jabatan')),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'usia' => $this->input->post('usia'),
				'agama' => implode(',', (array) $this->input->post('agama')),
				'pend_terakhir' => implode(',', (array) $this->input->post('pend_terakhir')),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'no_telp' => $this->input->post('no_telp'),
				'periode_mulai' => $this->input->post('periode_mulai'),
				'periode_selesai' => $this->input->post('periode_selesai'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
				'nip' => $this->input->post('nip'),
			];

			if (!is_dir(FCPATH . '/uploads/wilayah_kepala/')) {
				mkdir(FCPATH . '/uploads/wilayah_kepala/');
			}

			if (!empty($wilayah_kepala_avatar_name)) {
				$wilayah_kepala_avatar_name_copy = date('YmdHis') . '-' . $wilayah_kepala_avatar_name;

				rename(FCPATH . 'uploads/tmp/' . $wilayah_kepala_avatar_uuid . '/' . $wilayah_kepala_avatar_name, 
						FCPATH . 'uploads/wilayah_kepala/' . $wilayah_kepala_avatar_name_copy);

				if (!is_file(FCPATH . '/uploads/wilayah_kepala/' . $wilayah_kepala_avatar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['avatar'] = $wilayah_kepala_avatar_name_copy;
			}
		
			
			$save_wilayah_kepala = $this->model_wilayah_kepala->store($save_data);

			if ($save_wilayah_kepala) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_wilayah_kepala;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('wilayah_kepala/edit/' . $save_wilayah_kepala, 'Edit Wilayah Kepala'),
						anchor('wilayah_kepala', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('wilayah_kepala/edit/' . $save_wilayah_kepala, 'Edit Wilayah Kepala')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_kepala');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_kepala');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Wilayah Kepalas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('wilayah_kepala_update');

		$this->data['wilayah_kepala'] = $this->model_wilayah_kepala->find($id);

		$this->template->title('Kepala Desa Update');
		$this->render('modul/wilayah_kepala/wilayah_kepala_update', $this->data);
	}

	/**
	* Update Wilayah Kepalas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('wilayah_kepala_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jabatan[]', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('usia', 'Usia', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('agama[]', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pend_terakhir[]', 'Pend Terakhir', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('periode_mulai', 'Periode Mulai', 'trim|required');
		$this->form_validation->set_rules('periode_selesai', 'Periode Selesai', 'trim|required');
		$this->form_validation->set_rules('wilayah_kepala_avatar_name', 'Avatar', 'trim');
		
		if ($this->form_validation->run()) {
			$wilayah_kepala_avatar_uuid = $this->input->post('wilayah_kepala_avatar_uuid');
			$wilayah_kepala_avatar_name = $this->input->post('wilayah_kepala_avatar_name');
		
			$save_data = [
				
				'nama' => $this->input->post('nama'),
				'jabatan' => implode(',', (array) $this->input->post('jabatan')),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'usia' => $this->input->post('usia'),
				'agama' => implode(',', (array) $this->input->post('agama')),
				'pend_terakhir' => implode(',', (array) $this->input->post('pend_terakhir')),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'no_telp' => $this->input->post('no_telp'),
				'periode_mulai' => $this->input->post('periode_mulai'),
				'periode_selesai' => $this->input->post('periode_selesai'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
				'nip' => $this->input->post('nip'),
			];

			if (!is_dir(FCPATH . '/uploads/wilayah_kepala/')) {
				mkdir(FCPATH . '/uploads/wilayah_kepala/');
			}

			if (!empty($wilayah_kepala_avatar_uuid)) {
				$wilayah_kepala_avatar_name_copy = date('YmdHis') . '-' . $wilayah_kepala_avatar_name;

				rename(FCPATH . 'uploads/tmp/' . $wilayah_kepala_avatar_uuid . '/' . $wilayah_kepala_avatar_name, 
						FCPATH . 'uploads/wilayah_kepala/' . $wilayah_kepala_avatar_name_copy);

				if (!is_file(FCPATH . '/uploads/wilayah_kepala/' . $wilayah_kepala_avatar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['avatar'] = $wilayah_kepala_avatar_name_copy;
			}
		
			
			$save_wilayah_kepala = $this->model_wilayah_kepala->change($id, $save_data);

			if ($save_wilayah_kepala) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('wilayah_kepala', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_kepala');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_kepala');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Wilayah Kepalas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('wilayah_kepala_delete');

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
            set_message(cclang('has_been_deleted', 'wilayah_kepala'), 'success');
        } else {
            set_message(cclang('error_delete', 'wilayah_kepala'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Wilayah Kepalas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('wilayah_kepala_view');

		$this->data['wilayah_kepala'] = $this->model_wilayah_kepala->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Kepala Desa Detail');
		$this->render('modul/wilayah_kepala/wilayah_kepala_view', $this->data);
	}
	
	/**
	* delete Wilayah Kepalas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$wilayah_kepala = $this->model_wilayah_kepala->find($id);

		if (!empty($wilayah_kepala->avatar)) {
			$path = FCPATH . '/uploads/wilayah_kepala/' . $wilayah_kepala->avatar;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_wilayah_kepala->remove($id);
	}
	
	/**
	* Upload Image Wilayah Kepala	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		if (!$this->is_allowed('wilayah_kepala_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'wilayah_kepala',
			'allowed_types' => 'jpg|png|jpeg',
			'max_size' 	 	=> 2000,
		]);
	}

	/**
	* Delete Image Wilayah Kepala	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		if (!$this->is_allowed('wilayah_kepala_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'avatar', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'wilayah_kepala',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_kepala/'
        ]);
	}

	/**
	* Get Image Wilayah Kepala	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{
		if (!$this->is_allowed('wilayah_kepala_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$wilayah_kepala = $this->model_wilayah_kepala->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'avatar', 
            'table_name'        => 'wilayah_kepala',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_kepala/',
            'delete_endpoint'   => 'wilayah_kepala/delete_avatar_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('wilayah_kepala_export');

		$this->model_wilayah_kepala->export('wilayah_kepala', 'wilayah_kepala');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('wilayah_kepala_export');

		$this->model_wilayah_kepala->pdf('wilayah_kepala', 'wilayah_kepala');
	}
}


/* End of file wilayah_kepala.php */
/* Location: ./application/controllers/Wilayah Kepala.php */