<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Wilayah Perangkat Controller
*| --------------------------------------------------------------------------
*| Wilayah Perangkat site
*|
*/
class Wilayah_perangkat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_wilayah_perangkat');
	}

	/**
	* show all Wilayah Perangkats
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('wilayah_perangkat_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['wilayah_perangkats'] = $this->model_wilayah_perangkat->get($filter, $field, $this->limit_page, $offset);
		$this->data['wilayah_perangkat_counts'] = $this->model_wilayah_perangkat->count_all($filter, $field);

		$config = [
			'base_url'     => 'wilayah_perangkat/index/',
			'total_rows'   => $this->model_wilayah_perangkat->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Wilayah Perangkat List');
		$this->render('modul/wilayah_perangkat/wilayah_perangkat_list', $this->data);
	}
	
	/**
	* Add new wilayah_perangkats
	*
	*/
	public function add()
	{
		$this->is_allowed('wilayah_perangkat_add');

		$this->template->title('Wilayah Perangkat New');
		$this->render('modul/wilayah_perangkat/wilayah_perangkat_add', $this->data);
	}

	/**
	* Add New Wilayah Perangkats
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('wilayah_perangkat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('unsur_pem', 'Unsur Pemerintahan', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pend_terakhir', 'Pendidikan Terakhir', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|max_length[13]');
		$this->form_validation->set_rules('periode_mulai', 'Periode Mulai', 'trim|required');
		$this->form_validation->set_rules('periode_selesai', 'Periode Selesai', 'trim|required');
		$this->form_validation->set_rules('no_seq', 'No Urut', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('wilayah_perangkat_avatar_name', 'Foto', 'trim');
		

		if ($this->form_validation->run()) {
			$wilayah_perangkat_avatar_uuid = $this->input->post('wilayah_perangkat_avatar_uuid');
			$wilayah_perangkat_avatar_name = $this->input->post('wilayah_perangkat_avatar_name');
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nama' => $this->input->post('nama'),
				'unsur_pem' => $this->input->post('unsur_pem'),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'agama' => $this->input->post('agama'),
				'pend_terakhir' => $this->input->post('pend_terakhir'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'no_hp' => $this->input->post('no_hp'),
				'periode_mulai' => $this->input->post('periode_mulai'),
				'periode_selesai' => $this->input->post('periode_selesai'),
				'no_seq' => $this->input->post('no_seq'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/wilayah_perangkat/')) {
				mkdir(FCPATH . '/uploads/wilayah_perangkat/');
			}

			if (!empty($wilayah_perangkat_avatar_name)) {
				$wilayah_perangkat_avatar_name_copy = date('YmdHis') . '-' . $wilayah_perangkat_avatar_name;

				rename(FCPATH . 'uploads/tmp/' . $wilayah_perangkat_avatar_uuid . '/' . $wilayah_perangkat_avatar_name, 
						FCPATH . 'uploads/wilayah_perangkat/' . $wilayah_perangkat_avatar_name_copy);

				if (!is_file(FCPATH . '/uploads/wilayah_perangkat/' . $wilayah_perangkat_avatar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['avatar'] = $wilayah_perangkat_avatar_name_copy;
			}
		
			
			$save_wilayah_perangkat = $this->model_wilayah_perangkat->store($save_data);

			if ($save_wilayah_perangkat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_wilayah_perangkat;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('wilayah_perangkat/edit/' . $save_wilayah_perangkat, 'Edit Wilayah Perangkat'),
						anchor('wilayah_perangkat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('wilayah_perangkat/edit/' . $save_wilayah_perangkat, 'Edit Wilayah Perangkat')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_perangkat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_perangkat');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Wilayah Perangkats
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('wilayah_perangkat_update');

		$this->data['wilayah_perangkat'] = $this->model_wilayah_perangkat->find($id);

		$this->template->title('Wilayah Perangkat Update');
		$this->render('modul/wilayah_perangkat/wilayah_perangkat_update', $this->data);
	}

	/**
	* Update Wilayah Perangkats
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('wilayah_perangkat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		// $this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('unsur_pem', 'Unsur Pemerintahan', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required');
		$this->form_validation->set_rules('pend_terakhir', 'Pendidikan Terakhir', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'trim|required|max_length[13]');
		$this->form_validation->set_rules('periode_mulai', 'Periode Mulai', 'trim|required');
		$this->form_validation->set_rules('periode_selesai', 'Periode Selesai', 'trim|required');
		$this->form_validation->set_rules('no_seq', 'No Urut', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('wilayah_perangkat_avatar_name', 'Foto', 'trim');
		
		if ($this->form_validation->run()) {
			$wilayah_perangkat_avatar_uuid = $this->input->post('wilayah_perangkat_avatar_uuid');
			$wilayah_perangkat_avatar_name = $this->input->post('wilayah_perangkat_avatar_name');
		
			$save_data = [
				// 'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nama' => $this->input->post('nama'),
				'unsur_pem' => $this->input->post('unsur_pem'),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'agama' => $this->input->post('agama'),
				'pend_terakhir' => $this->input->post('pend_terakhir'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'no_hp' => $this->input->post('no_hp'),
				'periode_mulai' => $this->input->post('periode_mulai'),
				'periode_selesai' => $this->input->post('periode_selesai'),
				'no_seq' => $this->input->post('no_seq'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/wilayah_perangkat/')) {
				mkdir(FCPATH . '/uploads/wilayah_perangkat/');
			}

			if (!empty($wilayah_perangkat_avatar_uuid)) {
				$wilayah_perangkat_avatar_name_copy = date('YmdHis') . '-' . $wilayah_perangkat_avatar_name;

				rename(FCPATH . 'uploads/tmp/' . $wilayah_perangkat_avatar_uuid . '/' . $wilayah_perangkat_avatar_name, 
						FCPATH . 'uploads/wilayah_perangkat/' . $wilayah_perangkat_avatar_name_copy);

				if (!is_file(FCPATH . '/uploads/wilayah_perangkat/' . $wilayah_perangkat_avatar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['avatar'] = $wilayah_perangkat_avatar_name_copy;
			}
		
			
			$save_wilayah_perangkat = $this->model_wilayah_perangkat->change($id, $save_data);

			if ($save_wilayah_perangkat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('wilayah_perangkat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('wilayah_perangkat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('wilayah_perangkat');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Wilayah Perangkats
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('wilayah_perangkat_delete');

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
            set_message(cclang('has_been_deleted', 'wilayah_perangkat'), 'success');
        } else {
            set_message(cclang('error_delete', 'wilayah_perangkat'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Wilayah Perangkats
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('wilayah_perangkat_view');

		$this->data['wilayah_perangkat'] = $this->model_wilayah_perangkat->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Wilayah Perangkat Detail');
		$this->render('modul/wilayah_perangkat/wilayah_perangkat_view', $this->data);
	}
	
	/**
	* delete Wilayah Perangkats
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$wilayah_perangkat = $this->model_wilayah_perangkat->find($id);

		if (!empty($wilayah_perangkat->avatar)) {
			$path = FCPATH . '/uploads/wilayah_perangkat/' . $wilayah_perangkat->avatar;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_wilayah_perangkat->remove($id);
	}
	
	/**
	* Upload Image Wilayah Perangkat	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		if (!$this->is_allowed('wilayah_perangkat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'wilayah_perangkat',
			'allowed_types' => 'jpg|jpeg|png',
			'max_size' 	 	=> 2000,
		]);
	}

	/**
	* Delete Image Wilayah Perangkat	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		if (!$this->is_allowed('wilayah_perangkat_delete', false)) {
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
            'table_name'        => 'wilayah_perangkat',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_perangkat/'
        ]);
	}

	/**
	* Get Image Wilayah Perangkat	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{
		if (!$this->is_allowed('wilayah_perangkat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$wilayah_perangkat = $this->model_wilayah_perangkat->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'avatar', 
            'table_name'        => 'wilayah_perangkat',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/wilayah_perangkat/',
            'delete_endpoint'   => 'wilayah_perangkat/delete_avatar_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('wilayah_perangkat_export');

		$this->model_wilayah_perangkat->export('wilayah_perangkat', 'wilayah_perangkat');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('wilayah_perangkat_export');

		$this->model_wilayah_perangkat->pdf('wilayah_perangkat', 'wilayah_perangkat');
	}
}


/* End of file wilayah_perangkat.php */
/* Location: ./application/controllers/Wilayah Perangkat.php */