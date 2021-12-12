<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Aspirasi Controller
*| --------------------------------------------------------------------------
*| Tbl Aspirasi site
*|
*/
class Tbl_aspirasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_aspirasi');
	}

	/**
	* show all Tbl Aspirasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_aspirasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_aspirasis'] = $this->model_tbl_aspirasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_aspirasi_counts'] = $this->model_tbl_aspirasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_aspirasi/index/',
			'total_rows'   => $this->model_tbl_aspirasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Aspirasi List');
		$this->render('modul/tbl_aspirasi/tbl_aspirasi_list', $this->data);
	}
	
	/**
	* Add new tbl_aspirasis
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_aspirasi_add');

		$this->template->title('Aspirasi New');
		$this->render('modul/tbl_aspirasi/tbl_aspirasi_add', $this->data);
	}

	/**
	* Add New Tbl Aspirasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_aspirasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Wilayah', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Aspirasi', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_aspirasi = $this->model_tbl_aspirasi->store($save_data);

			if ($save_tbl_aspirasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_aspirasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_aspirasi/edit/' . $save_tbl_aspirasi, 'Edit Tbl Aspirasi'),
						anchor('tbl_aspirasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_aspirasi/edit/' . $save_tbl_aspirasi, 'Edit Tbl Aspirasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_aspirasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_aspirasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Aspirasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_aspirasi_update');

		$this->data['tbl_aspirasi'] = $this->model_tbl_aspirasi->find($id);

		$this->template->title('Aspirasi Update');
		$this->render('modul/tbl_aspirasi/tbl_aspirasi_update', $this->data);
	}

	/**
	* Update Tbl Aspirasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_aspirasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('balasan', 'Balasan', 'trim|required');
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				
				
				'keterangan' => $this->input->post('keterangan'),
				'balasan' => $this->input->post('balasan'),
				'status' => $this->input->post('status'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_aspirasi = $this->model_tbl_aspirasi->change($id, $save_data);

			if ($save_tbl_aspirasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_aspirasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_aspirasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_aspirasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Aspirasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_aspirasi_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_aspirasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_aspirasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Aspirasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_aspirasi_view');

		$this->data['tbl_aspirasi'] = $this->model_tbl_aspirasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Aspirasi Detail');
		$this->render('modul/tbl_aspirasi/tbl_aspirasi_view', $this->data);
	}
	
	/**
	* delete Tbl Aspirasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_aspirasi = $this->model_tbl_aspirasi->find($id);

		
		
		return $this->model_tbl_aspirasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_aspirasi_export');

		$this->model_tbl_aspirasi->export('tbl_aspirasi', 'tbl_aspirasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_aspirasi_export');

		$this->model_tbl_aspirasi->pdf('tbl_aspirasi', 'tbl_aspirasi');
	}
}


/* End of file tbl_aspirasi.php */
/* Location: ./application/controllers/Tbl Aspirasi.php */