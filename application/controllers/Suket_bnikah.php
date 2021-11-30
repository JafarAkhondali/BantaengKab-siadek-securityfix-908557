<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Suket Bnikah Controller
*| --------------------------------------------------------------------------
*| Suket Bnikah site
*|
*/
class Suket_bnikah extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_suket_bnikah');
		$this->load->library('Pdf');
	}

	/**
	* show all Suket Bnikahs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('suket_bnikah_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suket_bnikahs'] = $this->model_suket_bnikah->get($filter, $field, $this->limit_page, $offset);
		$this->data['suket_bnikah_counts'] = $this->model_suket_bnikah->count_all($filter, $field);

		$config = [
			'base_url'     => 'suket_bnikah/index/',
			'total_rows'   => $this->model_suket_bnikah->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Suket Belum Menikah List');
		$this->render('modul/suket_bnikah/suket_bnikah_list', $this->data);
	}
	
	/**
	* Add new suket_bnikahs
	*
	*/
	public function add()
	{
		$this->is_allowed('suket_bnikah_add');

		$this->template->title('Suket Belum Menikah New');
		$this->render('modul/suket_bnikah/suket_bnikah_add', $this->data);
	}

	/**
	* Add New Suket Bnikahs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('suket_bnikah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('no', 'NO. Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_bnikah = $this->model_suket_bnikah->store($save_data);
			$data = array(
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'surat_keluar_nomor' => $this->input->post('no'),
				'surat_keluar_jenis' => "bnikah" ,
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'Nik' => $this->input->post('nik'),
				'suket_id' => $save_suket_bnikah
		);
		
		$this->db->insert('surat_keluar', $data);
			

			if ($save_suket_bnikah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_suket_bnikah;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('suket_bnikah/edit/' . $save_suket_bnikah, 'Edit Suket Bnikah'),
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('suket_bnikah/edit/' . $save_suket_bnikah, 'Edit Suket Bnikah')
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
	* Update view Suket Bnikahs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('suket_bnikah_update');

		$this->data['suket_bnikah'] = $this->model_suket_bnikah->find($id);

		$this->template->title('Suket Belum Menikah Update');
		$this->render('modul/suket_bnikah/suket_bnikah_update', $this->data);
	}

	/**
	* Update Suket Bnikahs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('suket_bnikah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no', 'NO. Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_bnikah = $this->model_suket_bnikah->change($id, $save_data);

			if ($save_suket_bnikah) {
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
	* delete Suket Bnikahs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('suket_bnikah_delete');

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
            set_message(cclang('has_been_deleted', 'suket_bnikah'), 'success');
        } else {
            set_message(cclang('error_delete', 'suket_bnikah'), 'error');
        }

		redirect_back();
	}

	
	/**
	* delete Suket Bnikahs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$suket_bnikah = $this->model_suket_bnikah->find($id);

		
		
		return $this->model_suket_bnikah->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('suket_bnikah_export');

		$this->model_suket_bnikah->export('suket_bnikah', 'suket_bnikah');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('suket_bnikah_export');

		$this->model_suket_bnikah->pdf('suket_bnikah', 'suket_bnikah');
	}

	public function cetak($id, $kdwilayah)
	{

		$this->is_allowed('suket_bnikah_update');
		$a = db_get_all_data('wilayah', "kd_wilayah=$kdwilayah");
		foreach ($a as $as) {
			$kdinduk = $as->kd_induk;
		}
		$data['cetak'] = $this->model_suket_bnikah->cetak($id);

		$data['wilayah'] = $this->model_suket_bnikah->wilayah($kdwilayah);

		$this->load->view('modul/suket_bnikah/print_suket_bnikah', $data);
	}
}


/* End of file suket_bnikah.php */
/* Location: ./application/controllers/Suket Bnikah.php */