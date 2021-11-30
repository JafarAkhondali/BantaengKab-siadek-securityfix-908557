<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Suket Nikah Controller
*| --------------------------------------------------------------------------
*| Suket Nikah site
*|
*/
class Suket_nikah extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_suket_nikah');
		
		$this->load->library('Pdf');
	}

	/**
	* show all Suket Nikahs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('suket_nikah_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suket_nikahs'] = $this->model_suket_nikah->get($filter, $field, $this->limit_page, $offset);
		$this->data['suket_nikah_counts'] = $this->model_suket_nikah->count_all($filter, $field);

		$config = [
			'base_url'     => 'suket_nikah/index/',
			'total_rows'   => $this->model_suket_nikah->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Suket Menikah List');
		$this->render('modul/suket_nikah/suket_nikah_list', $this->data);
	}
	
	/**
	* Add new suket_nikahs
	*
	*/
	public function add()
	{
		$this->is_allowed('suket_nikah_add');

		$this->template->title('Suket Menikah New');
		$this->render('modul/suket_nikah/suket_nikah_add', $this->data);
	}

	/**
	* Add New Suket Nikahs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('suket_nikah_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('no', 'NO. Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('suami', 'Suami', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('istri', 'Istri', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'suami' => $this->input->post('suami'),
				'istri' => $this->input->post('istri'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_nikah = $this->model_suket_nikah->store($save_data);
			$data = array(
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'surat_keluar_nomor' => $this->input->post('no'),
				'surat_keluar_jenis' => "nikah" ,
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'Nik' => $this->input->post('suami'),
				'suket_id' => $save_suket_nikah
		);
		
		$this->db->insert('surat_keluar', $data);

			if ($save_suket_nikah) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_suket_nikah;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('suket_nikah/edit/' . $save_suket_nikah, 'Edit Suket Nikah'),
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('suket_nikah/edit/' . $save_suket_nikah, 'Edit Suket Nikah')
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
	* Update view Suket Nikahs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('suket_nikah_update');

		$this->data['suket_nikah'] = $this->model_suket_nikah->find($id);

		$this->template->title('Suket Menikah Update');
		$this->render('modul/suket_nikah/suket_nikah_update', $this->data);
	}

	/**
	* Update Suket Nikahs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('suket_nikah_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no', 'NO. Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('suami', 'Suami', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('istri', 'Istri', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang BerTTD', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no' => $this->input->post('no'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'suami' => $this->input->post('suami'),
				'istri' => $this->input->post('istri'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_nikah = $this->model_suket_nikah->change($id, $save_data);

			if ($save_suket_nikah) {
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
	* delete Suket Nikahs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('suket_nikah_delete');

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
            set_message(cclang('has_been_deleted', 'suket_nikah'), 'success');
        } else {
            set_message(cclang('error_delete', 'suket_nikah'), 'error');
        }

		redirect_back();
	}

	
	/**
	* delete Suket Nikahs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$suket_nikah = $this->model_suket_nikah->find($id);

		
		
		return $this->model_suket_nikah->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('suket_nikah_export');

		$this->model_suket_nikah->export('suket_nikah', 'suket_nikah');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('suket_nikah_export');

		$this->model_suket_nikah->pdf('suket_nikah', 'suket_nikah');
	}


	public function cetak($id, $kdwilayah)
	{

		$this->is_allowed('suket_nikah_update');
		$a = db_get_all_data('wilayah', "kd_wilayah=$kdwilayah");
		foreach ($a as $as) {
			$kdinduk = $as->kd_induk;
		}
		$data['cetak'] = $this->model_suket_nikah->cetak($id);

		$data['wilayah'] = $this->model_suket_nikah->wilayah($kdwilayah);

		$this->load->view('modul/suket_nikah/print_suket_nikah', $data);
	}
}


/* End of file suket_nikah.php */
/* Location: ./application/controllers/Suket Nikah.php */