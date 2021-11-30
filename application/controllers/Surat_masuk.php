<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Surat Masuk Controller
*| --------------------------------------------------------------------------
*| Surat Masuk site
*|
*/
class Surat_masuk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_surat_masuk');
	}

	/**
	* show all Surat Masuks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('surat_masuk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['surat_masuks'] = $this->model_surat_masuk->get($filter, $field, $this->limit_page, $offset);
		$this->data['surat_masuk_counts'] = $this->model_surat_masuk->count_all($filter, $field);

		$config = [
			'base_url'     => 'surat_masuk/index/',
			'total_rows'   => $this->model_surat_masuk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Surat Masuk List');
		$this->render('modul/surat_masuk/surat_masuk_list', $this->data);
	}
	
	/**
	* Add new surat_masuks
	*
	*/
	public function add()
	{
		$this->is_allowed('surat_masuk_add');

		$this->template->title('Surat Masuk New');
		$this->render('modul/surat_masuk/surat_masuk_add', $this->data);
	}

	/**
	* Add New Surat Masuks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('surat_masuk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('surat_masuk_nomor', 'Surat Masuk Nomor', 'trim|required');
		
		

		if ($this->form_validation->run()) {
			$surat_masuk_surat_masuk_file_uuid = $this->input->post('surat_masuk_surat_masuk_file_uuid');
			$surat_masuk_surat_masuk_file_name = $this->input->post('surat_masuk_surat_masuk_file_name');
		
			$save_data = [
				'kd_wilayah' =>get_user_data('kd_wilayah'),
				'surat_masuk_nomor' => $this->input->post('surat_masuk_nomor'),
				'surat_masuk_perihal' => $this->input->post('surat_masuk_perihal'),
				'surat_masuk_pengirim' => $this->input->post('surat_masuk_pengirim'),
				'surat_masuk_tgl_masuk' => $this->input->post('surat_masuk_tgl_masuk'),
				'surat_masuk_tgl_terima' => $this->input->post('surat_masuk_tgl_terima'),
				'surat_masuk_user' => get_user_data('username'),
				'surat_masuk' => date('Y-m-d H:i:s'),
				'surat_masuk_updete' => date('Y-m-d H:i:s'),
				'surat_masuk_user_update' => get_user_data('username'),
			];

			if (!is_dir(FCPATH . '/uploads/surat_masuk/')) {
				mkdir(FCPATH . '/uploads/surat_masuk/');
			}

			if (!empty($surat_masuk_surat_masuk_file_name)) {
				$surat_masuk_surat_masuk_file_name_copy = date('YmdHis') . '-' . $surat_masuk_surat_masuk_file_name;

				rename(FCPATH . 'uploads/tmp/' . $surat_masuk_surat_masuk_file_uuid . '/' . $surat_masuk_surat_masuk_file_name, 
						FCPATH . 'uploads/surat_masuk/' . $surat_masuk_surat_masuk_file_name_copy);

				if (!is_file(FCPATH . '/uploads/surat_masuk/' . $surat_masuk_surat_masuk_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_masuk_file'] = $surat_masuk_surat_masuk_file_name_copy;
			}
		
			
			$save_surat_masuk = $this->model_surat_masuk->store($save_data);

			if ($save_surat_masuk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_surat_masuk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('surat_masuk/edit/' . $save_surat_masuk, 'Edit Surat Masuk'),
						anchor('surat_masuk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('surat_masuk/edit/' . $save_surat_masuk, 'Edit Surat Masuk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_masuk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_masuk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Surat Masuks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('surat_masuk_update');

		$this->data['surat_masuk'] = $this->model_surat_masuk->find($id);

		$this->template->title('Surat Masuk Update');
		$this->render('modul/surat_masuk/surat_masuk_update', $this->data);
	}

	/**
	* Update Surat Masuks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('surat_masuk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('surat_masuk_nomor', 'Surat Masuk Nomor', 'trim|required');
		
		if ($this->form_validation->run()) {
			$surat_masuk_surat_masuk_file_uuid = $this->input->post('surat_masuk_surat_masuk_file_uuid');
			$surat_masuk_surat_masuk_file_name = $this->input->post('surat_masuk_surat_masuk_file_name');
		
			$save_data = [
				'kd_wilayah' =>get_user_data('kd_wilayah'),
				'surat_masuk_nomor' => $this->input->post('surat_masuk_nomor'),
				'surat_masuk_perihal' => $this->input->post('surat_masuk_perihal'),
				'surat_masuk_pengirim' => $this->input->post('surat_masuk_pengirim'),
				'surat_masuk_tgl_masuk' => $this->input->post('surat_masuk_tgl_masuk'),
				'surat_masuk_tgl_terima' => $this->input->post('surat_masuk_tgl_terima'),
				'surat_masuk_updete' => date('Y-m-d H:i:s'),
				'surat_masuk_user_update' => get_user_data('username'),
			];

			if (!is_dir(FCPATH . '/uploads/surat_masuk/')) {
				mkdir(FCPATH . '/uploads/surat_masuk/');
			}

			if (!empty($surat_masuk_surat_masuk_file_uuid)) {
				$surat_masuk_surat_masuk_file_name_copy = date('YmdHis') . '-' . $surat_masuk_surat_masuk_file_name;

				rename(FCPATH . 'uploads/tmp/' . $surat_masuk_surat_masuk_file_uuid . '/' . $surat_masuk_surat_masuk_file_name, 
						FCPATH . 'uploads/surat_masuk/' . $surat_masuk_surat_masuk_file_name_copy);

				if (!is_file(FCPATH . '/uploads/surat_masuk/' . $surat_masuk_surat_masuk_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['surat_masuk_file'] = $surat_masuk_surat_masuk_file_name_copy;
			}
		
			
			$save_surat_masuk = $this->model_surat_masuk->change($id, $save_data);

			if ($save_surat_masuk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('surat_masuk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_masuk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_masuk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Surat Masuks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('surat_masuk_delete');

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
            set_message(cclang('has_been_deleted', 'surat_masuk'), 'success');
        } else {
            set_message(cclang('error_delete', 'surat_masuk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Surat Masuks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('surat_masuk_view');

		$this->data['surat_masuk'] = $this->model_surat_masuk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Surat Masuk Detail');
		$this->render('modul/surat_masuk/surat_masuk_view', $this->data);
	}
	
	/**
	* delete Surat Masuks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$surat_masuk = $this->model_surat_masuk->find($id);

		if (!empty($surat_masuk->surat_masuk_file)) {
			$path = FCPATH . '/uploads/surat_masuk/' . $surat_masuk->surat_masuk_file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_surat_masuk->remove($id);
	}
	
	/**
	* Upload Image Surat Masuk	* 
	* @return JSON
	*/
	public function upload_surat_masuk_file_file()
	{
		if (!$this->is_allowed('surat_masuk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'surat_masuk',
		]);
	}

	/**
	* Delete Image Surat Masuk	* 
	* @return JSON
	*/
	public function delete_surat_masuk_file_file($uuid)
	{
		if (!$this->is_allowed('surat_masuk_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'surat_masuk_file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'surat_masuk',
            'primary_key'       => 'id_surat_masuk',
            'upload_path'       => 'uploads/surat_masuk/'
        ]);
	}

	/**
	* Get Image Surat Masuk	* 
	* @return JSON
	*/
	public function get_surat_masuk_file_file($id)
	{
		if (!$this->is_allowed('surat_masuk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$surat_masuk = $this->model_surat_masuk->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'surat_masuk_file', 
            'table_name'        => 'surat_masuk',
            'primary_key'       => 'id_surat_masuk',
            'upload_path'       => 'uploads/surat_masuk/',
            'delete_endpoint'   => 'surat_masuk/delete_surat_masuk_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('surat_masuk_export');

		$this->model_surat_masuk->export('surat_masuk', 'surat_masuk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('surat_masuk_export');

		$this->model_surat_masuk->pdf('surat_masuk', 'surat_masuk');
	}
}


/* End of file surat_masuk.php */
/* Location: ./application/controllers/Surat Masuk.php */