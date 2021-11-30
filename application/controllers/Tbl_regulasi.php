<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Regulasi Controller
*| --------------------------------------------------------------------------
*| Tbl Regulasi site
*|
*/
class Tbl_regulasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_regulasi');
	}

	/**
	* show all Tbl Regulasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_regulasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_regulasis'] = $this->model_tbl_regulasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_regulasi_counts'] = $this->model_tbl_regulasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_regulasi/index/',
			'total_rows'   => $this->model_tbl_regulasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Regulasi List');
		$this->render('modul/tbl_regulasi/tbl_regulasi_list', $this->data);
	}
	
	/**
	* Add new tbl_regulasis
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_regulasi_add');

		$this->template->title('Tbl Regulasi New');
		$this->render('modul/tbl_regulasi/tbl_regulasi_add', $this->data);
	}

	/**
	* Add New Tbl Regulasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_regulasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('regulasi_jenis', 'Regulasi Jenis', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tbl_regulasi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('no_regulasi', 'No Regulasi', 'trim|required');
		$this->form_validation->set_rules('status[]', 'Status', 'trim|required');
		

		if ($this->form_validation->run()) {
			$tbl_regulasi_file_uuid = $this->input->post('tbl_regulasi_file_uuid');
			$tbl_regulasi_file_name = $this->input->post('tbl_regulasi_file_name');
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'regulasi_jenis' => $this->input->post('regulasi_jenis'),
				'keterangan' => $this->input->post('keterangan'),
				'no_regulasi' => $this->input->post('no_regulasi'),
				'status' => implode(',', (array) $this->input->post('status')),
				'tahun' => $this->input->post('tahun'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
				'last_updated_by' =>get_user_data('username'),
				'last_updated_date' =>date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_regulasi/')) {
				mkdir(FCPATH . '/uploads/tbl_regulasi/');
			}

			if (!empty($tbl_regulasi_file_name)) {
				$tbl_regulasi_file_name_copy = date('YmdHis') . '-' . $tbl_regulasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_regulasi_file_uuid . '/' . $tbl_regulasi_file_name, 
						FCPATH . 'uploads/tbl_regulasi/' . $tbl_regulasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_regulasi/' . $tbl_regulasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $tbl_regulasi_file_name_copy;
			}
		
			
			$save_tbl_regulasi = $this->model_tbl_regulasi->store($save_data);

			if ($save_tbl_regulasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_regulasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_regulasi/edit/' . $save_tbl_regulasi, 'Edit Tbl Regulasi'),
						anchor('tbl_regulasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_regulasi/edit/' . $save_tbl_regulasi, 'Edit Tbl Regulasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_regulasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_regulasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Regulasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_regulasi_update');

		$this->data['tbl_regulasi'] = $this->model_tbl_regulasi->find($id);

		$this->template->title('Tbl Regulasi Update');
		$this->render('modul/tbl_regulasi/tbl_regulasi_update', $this->data);
	}

	/**
	* Update Tbl Regulasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_regulasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		$this->form_validation->set_rules('regulasi_jenis', 'Regulasi Jenis', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tbl_regulasi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('no_regulasi', 'No Regulasi', 'trim|required');
		$this->form_validation->set_rules('status[]', 'Status', 'trim|required');
		
		if ($this->form_validation->run()) {
			$tbl_regulasi_file_uuid = $this->input->post('tbl_regulasi_file_uuid');
			$tbl_regulasi_file_name = $this->input->post('tbl_regulasi_file_name');
		
			$save_data = [
				
				'regulasi_jenis' => $this->input->post('regulasi_jenis'),
				'keterangan' => $this->input->post('keterangan'),
				'no_regulasi' => $this->input->post('no_regulasi'),
				'status' => implode(',', (array) $this->input->post('status')),
				'tahun' => $this->input->post('tahun'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' =>date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_regulasi/')) {
				mkdir(FCPATH . '/uploads/tbl_regulasi/');
			}

			if (!empty($tbl_regulasi_file_uuid)) {
				$tbl_regulasi_file_name_copy = date('YmdHis') . '-' . $tbl_regulasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $tbl_regulasi_file_uuid . '/' . $tbl_regulasi_file_name, 
						FCPATH . 'uploads/tbl_regulasi/' . $tbl_regulasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/tbl_regulasi/' . $tbl_regulasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $tbl_regulasi_file_name_copy;
			}
		
			
			$save_tbl_regulasi = $this->model_tbl_regulasi->change($id, $save_data);

			if ($save_tbl_regulasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_regulasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_regulasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_regulasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Regulasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_regulasi_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_regulasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_regulasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Regulasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_regulasi_view');

		$this->data['tbl_regulasi'] = $this->model_tbl_regulasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Regulasi Detail');
		$this->render('modul/tbl_regulasi/tbl_regulasi_view', $this->data);
	}
	
	/**
	* delete Tbl Regulasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_regulasi = $this->model_tbl_regulasi->find($id);

		if (!empty($tbl_regulasi->file)) {
			$path = FCPATH . '/uploads/tbl_regulasi/' . $tbl_regulasi->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_tbl_regulasi->remove($id);
	}
	
	/**
	* Upload Image Tbl Regulasi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('tbl_regulasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_regulasi',
		]);
	}

	/**
	* Delete Image Tbl Regulasi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('tbl_regulasi_delete', false)) {
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
            'table_name'        => 'tbl_regulasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_regulasi/'
        ]);
	}

	/**
	* Get Image Tbl Regulasi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('tbl_regulasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_regulasi = $this->model_tbl_regulasi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'tbl_regulasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_regulasi/',
            'delete_endpoint'   => 'tbl_regulasi/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_regulasi_export');

		$this->model_tbl_regulasi->export('tbl_regulasi', 'tbl_regulasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_regulasi_export');

		$this->model_tbl_regulasi->pdf('tbl_regulasi', 'tbl_regulasi');
	}
}


/* End of file tbl_regulasi.php */
/* Location: ./application/controllers/Tbl Regulasi.php */