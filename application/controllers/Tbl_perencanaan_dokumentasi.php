<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Dokumentasi Controller
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Dokumentasi site
*|
*/
class Tbl_perencanaan_dokumentasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_perencanaan_dokumentasi');
	}

	/**
	* show all Tbl Perencanaan Dokumentasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_perencanaan_dokumentasis'] = $this->model_tbl_perencanaan_dokumentasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_perencanaan_dokumentasi_counts'] = $this->model_tbl_perencanaan_dokumentasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_perencanaan_dokumentasi/index/',
			'total_rows'   => $this->model_tbl_perencanaan_dokumentasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Perencanaan List');
		$this->render('modul/tbl_perencanaan_dokumentasi/tbl_perencanaan_dokumentasi_list', $this->data);
	}
	
	/**
	* Add new tbl_perencanaan_dokumentasis
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_add');

		$this->template->title('Dokumentasi Perencanaan New');
		$this->render('modul/tbl_perencanaan_dokumentasi/tbl_perencanaan_dokumentasi_add', $this->data);
	}

	/**
	* Add New Tbl Perencanaan Dokumentasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_perencanaan_dokumentasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tbl_perencanaan_dokumentasi_file_name[]', 'File', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'keterangan' => $this->input->post('keterangan'),
			];

			if (!is_dir(FCPATH . '/uploads/tbl_perencanaan_dokumentasi/')) {
				mkdir(FCPATH . '/uploads/tbl_perencanaan_dokumentasi/');
			}

			if (count((array) $this->input->post('tbl_perencanaan_dokumentasi_file_name'))) {
				foreach ((array) $_POST['tbl_perencanaan_dokumentasi_file_name'] as $idx => $file_name) {
					$tbl_perencanaan_dokumentasi_file_name_copy = date('YmdHis') . '-' . $file_name;

					rename(FCPATH . 'uploads/tmp/' . $_POST['tbl_perencanaan_dokumentasi_file_uuid'][$idx] . '/' .  $file_name, 
							FCPATH . 'uploads/tbl_perencanaan_dokumentasi/' . $tbl_perencanaan_dokumentasi_file_name_copy);

					$listed_image[] = $tbl_perencanaan_dokumentasi_file_name_copy;

					if (!is_file(FCPATH . '/uploads/tbl_perencanaan_dokumentasi/' . $tbl_perencanaan_dokumentasi_file_name_copy)) {
						echo json_encode([
							'success' => false,
							'message' => 'Error uploading file'
							]);
						exit;
					}
				}

				$save_data['file'] = implode($listed_image, ',');
			}
		
			
			$save_tbl_perencanaan_dokumentasi = $this->model_tbl_perencanaan_dokumentasi->store($save_data);

			if ($save_tbl_perencanaan_dokumentasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_perencanaan_dokumentasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_perencanaan_dokumentasi/edit/' . $save_tbl_perencanaan_dokumentasi, 'Edit Tbl Perencanaan Dokumentasi'),
						anchor('tbl_perencanaan_dokumentasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_perencanaan_dokumentasi/edit/' . $save_tbl_perencanaan_dokumentasi, 'Edit Tbl Perencanaan Dokumentasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_dokumentasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_dokumentasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Perencanaan Dokumentasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_update');

		$this->data['tbl_perencanaan_dokumentasi'] = $this->model_tbl_perencanaan_dokumentasi->find($id);

		$this->template->title('Dokumentasi Perencanaan Update');
		$this->render('modul/tbl_perencanaan_dokumentasi/tbl_perencanaan_dokumentasi_update', $this->data);
	}

	/**
	* Update Tbl Perencanaan Dokumentasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_perencanaan_dokumentasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('tbl_perencanaan_dokumentasi_file_name[]', 'File', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'keterangan' => $this->input->post('keterangan'),
			];

			$listed_image = [];
			if (count((array) $this->input->post('tbl_perencanaan_dokumentasi_file_name'))) {
				foreach ((array) $_POST['tbl_perencanaan_dokumentasi_file_name'] as $idx => $file_name) {
					if (isset($_POST['tbl_perencanaan_dokumentasi_file_uuid'][$idx]) AND !empty($_POST['tbl_perencanaan_dokumentasi_file_uuid'][$idx])) {
						$tbl_perencanaan_dokumentasi_file_name_copy = date('YmdHis') . '-' . $file_name;

						rename(FCPATH . 'uploads/tmp/' . $_POST['tbl_perencanaan_dokumentasi_file_uuid'][$idx] . '/' .  $file_name, 
								FCPATH . 'uploads/tbl_perencanaan_dokumentasi/' . $tbl_perencanaan_dokumentasi_file_name_copy);

						$listed_image[] = $tbl_perencanaan_dokumentasi_file_name_copy;

						if (!is_file(FCPATH . '/uploads/tbl_perencanaan_dokumentasi/' . $tbl_perencanaan_dokumentasi_file_name_copy)) {
							echo json_encode([
								'success' => false,
								'message' => 'Error uploading file'
								]);
							exit;
						}
					} else {
						$listed_image[] = $file_name;
					}
				}
			}
			
			$save_data['file'] = implode($listed_image, ',');
		
			
			$save_tbl_perencanaan_dokumentasi = $this->model_tbl_perencanaan_dokumentasi->change($id, $save_data);

			if ($save_tbl_perencanaan_dokumentasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_perencanaan_dokumentasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_dokumentasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_dokumentasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Perencanaan Dokumentasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_perencanaan_dokumentasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_perencanaan_dokumentasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Perencanaan Dokumentasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_view');

		$this->data['tbl_perencanaan_dokumentasi'] = $this->model_tbl_perencanaan_dokumentasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Perencanaan Detail');
		$this->render('modul/tbl_perencanaan_dokumentasi/tbl_perencanaan_dokumentasi_view', $this->data);
	}
	
	/**
	* delete Tbl Perencanaan Dokumentasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_perencanaan_dokumentasi = $this->model_tbl_perencanaan_dokumentasi->find($id);

		
		if (!empty($tbl_perencanaan_dokumentasi->file)) {
			foreach ((array) explode(',', $tbl_perencanaan_dokumentasi->file) as $filename) {
				$path = FCPATH . '/uploads/tbl_perencanaan_dokumentasi/' . $filename;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}
		}
		
		return $this->model_tbl_perencanaan_dokumentasi->remove($id);
	}
	
	
	/**
	* Upload Image Tbl Perencanaan Dokumentasi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('tbl_perencanaan_dokumentasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'tbl_perencanaan_dokumentasi',
		]);
	}

	/**
	* Delete Image Tbl Perencanaan Dokumentasi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('tbl_perencanaan_dokumentasi_delete', false)) {
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
            'table_name'        => 'tbl_perencanaan_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_perencanaan_dokumentasi/'
        ]);
	}

	/**
	* Get Image Tbl Perencanaan Dokumentasi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('tbl_perencanaan_dokumentasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$tbl_perencanaan_dokumentasi = $this->model_tbl_perencanaan_dokumentasi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'tbl_perencanaan_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/tbl_perencanaan_dokumentasi/',
            'delete_endpoint'   => 'tbl_perencanaan_dokumentasi/delete_file_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_export');

		$this->model_tbl_perencanaan_dokumentasi->export('tbl_perencanaan_dokumentasi', 'tbl_perencanaan_dokumentasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_perencanaan_dokumentasi_export');

		$this->model_tbl_perencanaan_dokumentasi->pdf('tbl_perencanaan_dokumentasi', 'tbl_perencanaan_dokumentasi');
	}
}


/* End of file tbl_perencanaan_dokumentasi.php */
/* Location: ./application/controllers/Tbl Perencanaan Dokumentasi.php */