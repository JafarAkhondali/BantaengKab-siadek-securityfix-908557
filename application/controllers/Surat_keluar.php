<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Surat Keluar Controller
*| --------------------------------------------------------------------------
*| Surat Keluar site
*|
*/
class Surat_keluar extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_surat_keluar');
		$this->load->library('Pdf');
	}

	/**
	* show all Surat Keluars
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('surat_keluar_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['surat_keluars'] = $this->model_surat_keluar->get($filter, $field, $this->limit_page, $offset);
		$this->data['surat_keluar_counts'] = $this->model_surat_keluar->count_all($filter, $field);

		$config = [
			'base_url'     => 'surat_keluar/index/',
			'total_rows'   => $this->model_surat_keluar->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Surat Keluar List');
		$this->render('modul/surat_keluar/surat_keluar_list', $this->data);
	}
	
	/**
	* Add new surat_keluars
	*
	*/
	public function add()
	{
		$this->is_allowed('surat_keluar_add');

		$this->template->title('Surat Keluar New');
		$this->render('modul/surat_keluar/surat_keluar_add', $this->data);
	}

	/**
	* Add New Surat Keluars
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('surat_keluar_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('Nik', 'Nik', 'trim|required');
		$this->form_validation->set_rules('surat_keluar_nomor', 'Surat Keluar Nomor', 'trim|required');
		$this->form_validation->set_rules('surat_keluar_file_name', 'File', 'trim');
		

		if ($this->form_validation->run()) {
			$surat_keluar_file_uuid = $this->input->post('surat_keluar_file_uuid');
			$surat_keluar_file_name = $this->input->post('surat_keluar_file_name');
		
			$save_data = [
				'Nik' => $this->input->post('Nik'),
				'surat_keluar_nomor' => $this->input->post('surat_keluar_nomor'),
				'surat_keluar_jenis' => $this->input->post('surat_keluar_jenis'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/surat_keluar/')) {
				mkdir(FCPATH . '/uploads/surat_keluar/');
			}

			if (!empty($surat_keluar_file_name)) {
				$surat_keluar_file_name_copy = date('YmdHis') . '-' . $surat_keluar_file_name;

				rename(FCPATH . 'uploads/tmp/' . $surat_keluar_file_uuid . '/' . $surat_keluar_file_name, 
						FCPATH . 'uploads/surat_keluar/' . $surat_keluar_file_name_copy);

				if (!is_file(FCPATH . '/uploads/surat_keluar/' . $surat_keluar_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $surat_keluar_file_name_copy;
			}
		
			
			$save_surat_keluar = $this->model_surat_keluar->store($save_data);

			if ($save_surat_keluar) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_surat_keluar;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('surat_keluar/edit/' . $save_surat_keluar, 'Edit Surat Keluar'),
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('surat_keluar/edit/' . $save_surat_keluar, 'Edit Surat Keluar')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_keluar');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Surat Keluars
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('surat_keluar_update');

		$this->data['surat_keluar'] = $this->model_surat_keluar->find($id);

		$this->template->title('Surat Keluar Update');
		$this->render('modul/surat_keluar/surat_keluar_update', $this->data);
	}

	/**
	* Update Surat Keluars
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('surat_keluar_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('Nik', 'Nik', 'trim|required');
		$this->form_validation->set_rules('surat_keluar_nomor', 'Surat Keluar Nomor', 'trim|required');
		$this->form_validation->set_rules('surat_keluar_file_name', 'File', 'trim');
		
		if ($this->form_validation->run()) {
			$surat_keluar_file_uuid = $this->input->post('surat_keluar_file_uuid');
			$surat_keluar_file_name = $this->input->post('surat_keluar_file_name');
		
			$save_data = [
				'Nik' => $this->input->post('Nik'),
				'surat_keluar_nomor' => $this->input->post('surat_keluar_nomor'),
				'surat_keluar_jenis' => $this->input->post('surat_keluar_jenis'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/surat_keluar/')) {
				mkdir(FCPATH . '/uploads/surat_keluar/');
			}

			if (!empty($surat_keluar_file_uuid)) {
				$surat_keluar_file_name_copy = date('YmdHis') . '-' . $surat_keluar_file_name;

				rename(FCPATH . 'uploads/tmp/' . $surat_keluar_file_uuid . '/' . $surat_keluar_file_name, 
						FCPATH . 'uploads/surat_keluar/' . $surat_keluar_file_name_copy);

				if (!is_file(FCPATH . '/uploads/surat_keluar/' . $surat_keluar_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $surat_keluar_file_name_copy;
			}
		
			
			$save_surat_keluar = $this->model_surat_keluar->change($id, $save_data);

			if ($save_surat_keluar) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_keluar');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Surat Keluars
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('surat_keluar_delete');

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
            set_message(cclang('has_been_deleted', 'surat_keluar'), 'success');
        } else {
            set_message(cclang('error_delete', 'surat_keluar'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Surat Keluars
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('surat_keluar_view');

		$this->data['surat_keluar'] = $this->model_surat_keluar->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Surat Keluar Detail');
		$this->render('modul/surat_keluar/surat_keluar_view', $this->data);
	}
	
	/**
	* delete Surat Keluars
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$surat_keluar = $this->model_surat_keluar->find($id);

		if (!empty($surat_keluar->file)) {
			$path = FCPATH . '/uploads/surat_keluar/' . $surat_keluar->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_surat_keluar->remove($id);
	}
	
	/**
	* Upload Image Surat Keluar	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('surat_keluar_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'surat_keluar',
			'allowed_types' => 'jpg|jpeg|png|xls|xlsx|doc|docx',
			'max_size' 	 	=> 3000,
		]);
	}

	/**
	* Delete Image Surat Keluar	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('surat_keluar_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'surat_keluar',
            'primary_key'       => 'id_surat_keluar',
            'upload_path'       => 'uploads/surat_keluar/'
        ]);
	}

	/**
	* Get Image Surat Keluar	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('surat_keluar_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$surat_keluar = $this->model_surat_keluar->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'surat_keluar',
            'primary_key'       => 'id_surat_keluar',
            'upload_path'       => 'uploads/surat_keluar/',
            'delete_endpoint'   => 'surat_keluar/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('surat_keluar_export');

		$this->model_surat_keluar->export('surat_keluar', 'surat_keluar');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('surat_keluar_export');

		$this->model_surat_keluar->pdf('surat_keluar', 'surat_keluar');
	}



	public function cetak($id, $kdwilayah,$jenis)
	{

		$this->is_allowed('suket_nikah_add');
		$a = db_get_all_data('wilayah', "kd_wilayah=$kdwilayah");
		foreach ($a as $as) {
			$kdinduk = $as->kd_induk;
		}
		
		$data['cetak'] = $this->model_surat_keluar->cetak($id,$jenis);

		$data['wilayah'] = $this->model_surat_keluar->wilayah($kdwilayah);

		$this->load->view('modul/surat_keluar/print_suket_'.$jenis.'', $data);
	}
}


/* End of file surat_keluar.php */
/* Location: ./application/controllers/Surat Keluar.php */