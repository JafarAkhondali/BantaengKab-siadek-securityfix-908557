<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Suket Kematian Controller
*| --------------------------------------------------------------------------
*| Suket Kematian site
*|
*/
class Suket_kematian extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_suket_kematian');
		$this->load->library('Pdf');
	}

	/**
	* show all Suket Kematians
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('suket_kematian_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suket_kematians'] = $this->model_suket_kematian->get($filter, $field, $this->limit_page, $offset);
		$this->data['suket_kematian_counts'] = $this->model_suket_kematian->count_all($filter, $field);

		$config = [
			'base_url'     => 'suket_kematian/index/',
			'total_rows'   => $this->model_suket_kematian->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Suket Kematian List');
		$this->render('modul/suket_kematian/suket_kematian_list', $this->data);
	}
	
	/**
	* Add new suket_kematians
	*
	*/
	public function add()
	{
		$this->is_allowed('suket_kematian_add');

		$this->template->title('Suket Kematian New');
		$this->render('modul/suket_kematian/suket_kematian_add', $this->data);
	}

	/**
	* Add New Suket Kematians
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('suket_kematian_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('no', 'NO.Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('waktu_kematian', 'Waktu Kematian', 'trim|required');
		$this->form_validation->set_rules('tempat_kematian', 'Tempat Kematian', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'waktu_kematian' => $this->input->post('waktu_kematian'),
				'tempat_kematian' => $this->input->post('tempat_kematian'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_kematian = $this->model_suket_kematian->store($save_data);
			$data = array(
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'surat_keluar_nomor' => $this->input->post('no'),
				'surat_keluar_jenis' => "kematian" ,
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'Nik' => $this->input->post('nik'),
				'suket_id' => $save_suket_kematian
		);
		
		$this->db->insert('surat_keluar', $data);

			if ($save_suket_kematian) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_suket_kematian;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('suket_kematian/edit/' . $save_suket_kematian, 'Edit Suket Kematian'),
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('suket_kematian/edit/' . $save_suket_kematian, 'Edit Suket Kematian')
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
	* Update view Suket Kematians
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('suket_kematian_update');

		$this->data['suket_kematian'] = $this->model_suket_kematian->find($id);

		$this->template->title('Suket Kematian Update');
		$this->render('modul/suket_kematian/suket_kematian_update', $this->data);
	}

	/**
	* Update Suket Kematians
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('suket_kematian_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no', 'NO.Surat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('waktu_kematian', 'Waktu Kematian', 'trim|required');
		$this->form_validation->set_rules('tempat_kematian', 'Tempat Kematian', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'waktu_kematian' => $this->input->post('waktu_kematian'),
				'tempat_kematian' => $this->input->post('tempat_kematian'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_kematian = $this->model_suket_kematian->change($id, $save_data);

			if ($save_suket_kematian) {
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
	* delete Suket Kematians
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('suket_kematian_delete');

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
            set_message(cclang('has_been_deleted', 'suket_kematian'), 'success');
        } else {
            set_message(cclang('error_delete', 'suket_kematian'), 'error');
        }

		redirect_back();
	}

	
	/**
	* delete Suket Kematians
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$suket_kematian = $this->model_suket_kematian->find($id);

		
		
		return $this->model_suket_kematian->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('suket_kematian_export');

		$this->model_suket_kematian->export('suket_kematian', 'suket_kematian');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('suket_kematian_export');

		$this->model_suket_kematian->pdf('suket_kematian', 'suket_kematian');
	}

	public function cetak($id, $kdwilayah)
	{

		$this->is_allowed('suket_kematian_update');
		$a = db_get_all_data('wilayah', "kd_wilayah=$kdwilayah");
		foreach ($a as $as) {
			$kdinduk = $as->kd_induk;
		}
		$data['cetak'] = $this->model_suket_kematian->cetak($id);

		$data['wilayah'] = $this->model_suket_kematian->wilayah($kdwilayah);

		$this->load->view('modul/suket_kematian/print_suket_kematian', $data);
	}
}


/* End of file suket_kematian.php */
/* Location: ./application/controllers/Suket Kematian.php */