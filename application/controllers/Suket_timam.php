<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Suket Timam Controller
 *| --------------------------------------------------------------------------
 *| Suket Timam site
 *|
 */
class Suket_timam extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_suket_timam');

		$this->load->library('Pdf');
	}

	/**
	 * show all Suket Timams
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('suket_timam_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suket_timams'] = $this->model_suket_timam->get($filter, $field, $this->limit_page, $offset);
		$this->data['suket_timam_counts'] = $this->model_suket_timam->count_all($filter, $field);

		$config = [
			'base_url'     => 'suket_timam/index/',
			'total_rows'   => $this->model_suket_timam->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Surat Keterangan Tidak Mampu List');
		$this->render('modul/suket_timam/suket_timam_list', $this->data);
	}

	/**
	 * Add new suket_timams
	 *
	 */
	public function add()
	{
		$this->is_allowed('suket_timam_add');

		$this->template->title('Surat Keterangan Tidak Mampu New');
		$this->render('modul/suket_timam/suket_timam_add', $this->data);
	}

	/**
	 * Add New Suket Timams
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('suket_timam_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('no', 'No.Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang Bertanda Tangan', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no' => $this->input->post('no'),
				'perihal_surat' => $this->input->post('perihal_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];


			$save_suket_timam = $this->model_suket_timam->store($save_data);
			$data = array(
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'surat_keluar_nomor' => $this->input->post('no'),
				'surat_keluar_jenis' => "timam" ,
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'Nik' => $this->input->post('nik'),
				'suket_id' => $save_suket_timam
		);
		
		$this->db->insert('surat_keluar', $data);

			if ($save_suket_timam) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_suket_timam;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('suket_timam/edit/' . $save_suket_timam, 'Edit Suket Timam'),
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('suket_timam/edit/' . $save_suket_timam, 'Edit Suket Timam')
						]),
						'success'
					);

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
	 * Update view Suket Timams
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('suket_timam_update');

		$this->data['suket_timam'] = $this->model_suket_timam->find($id);

		$this->template->title('Surat Keterangan Tidak Mampu Update');
		$this->render('modul/suket_timam/suket_timam_update', $this->data);
	}

	/**
	 * Update Suket Timams
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('suket_timam_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}


		$this->form_validation->set_rules('no', 'No.Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('perangkat_id', 'Perangkat Yang Bertanda Tangan', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [

				'no' => $this->input->post('no'),
				'perihal_surat' => $this->input->post('perihal_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'nik' => $this->input->post('nik'),
				'perangkat_id' => $this->input->post('perangkat_id'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];


			$save_suket_timam = $this->model_suket_timam->change($id, $save_data);

			if ($save_suket_timam) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

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
	 * delete Suket Timams
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('suket_timam_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'suket_timam'), 'success');
		} else {
			set_message(cclang('error_delete', 'suket_timam'), 'error');
		}

		redirect_back();
	}


	/**
	 * delete Suket Timams
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$suket_timam = $this->model_suket_timam->find($id);



		return $this->model_suket_timam->remove($id);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('suket_timam_export');

		$this->model_suket_timam->export('suket_timam', 'suket_timam');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('suket_timam_export');

		$this->model_suket_timam->pdf('suket_timam', 'suket_timam');
	}

	public function cetak($id, $kdwilayah)
	{

		$this->is_allowed('suket_timam_update');
		$a = db_get_all_data('wilayah', "kd_wilayah=$kdwilayah");
		foreach ($a as $as) {
			$kdinduk = $as->kd_induk;
		}
		$data['cetak'] = $this->model_suket_timam->cetak($id);

		$data['wilayah'] = $this->model_suket_timam->wilayah($kdwilayah);

		$this->load->view('modul/suket_timam/print_suket_timam', $data);
	}
}


/* End of file suket_timam.php */
/* Location: ./application/controllers/Suket Timam.php */
