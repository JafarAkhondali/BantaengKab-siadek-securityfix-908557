<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Realisasi Controller
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Realisasi site
*|
*/
class Tbl_perencanaan_realisasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_perencanaan_realisasi');
	}

	/**
	* show all Tbl Perencanaan Realisasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_perencanaan_realisasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_perencanaan_realisasis'] = $this->model_tbl_perencanaan_realisasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_perencanaan_realisasi_counts'] = $this->model_tbl_perencanaan_realisasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_perencanaan_realisasi/index/',
			'total_rows'   => $this->model_tbl_perencanaan_realisasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Realisasi Pembangunan List');
		$this->render('modul/tbl_perencanaan_realisasi/tbl_perencanaan_realisasi_list', $this->data);
	}
	
	/**
	* Add new tbl_perencanaan_realisasis
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_perencanaan_realisasi_add');

		$this->template->title('Realisasi Pembangunan New');
		$this->render('modul/tbl_perencanaan_realisasi/tbl_perencanaan_realisasi_add', $this->data);
	}

	/**
	* Add New Tbl Perencanaan Realisasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_perencanaan_realisasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Kegiatan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('anggaran', 'Anggaran', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'bidang' => $this->input->post('bidang'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume' => $this->input->post('volume'),
				'lokasi' => $this->input->post('lokasi'),
				'sumber_dana' => $this->input->post('sumber_dana'),
				'anggaran' => $this->input->post('anggaran'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_perencanaan_realisasi = $this->model_tbl_perencanaan_realisasi->store($save_data);

			if ($save_tbl_perencanaan_realisasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_perencanaan_realisasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_perencanaan_realisasi/edit/' . $save_tbl_perencanaan_realisasi, 'Edit Tbl Perencanaan Realisasi'),
						anchor('tbl_perencanaan_realisasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_perencanaan_realisasi/edit/' . $save_tbl_perencanaan_realisasi, 'Edit Tbl Perencanaan Realisasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_realisasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_realisasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Perencanaan Realisasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_perencanaan_realisasi_update');

		$this->data['tbl_perencanaan_realisasi'] = $this->model_tbl_perencanaan_realisasi->find($id);

		$this->template->title('Realisasi Pembangunan Update');
		$this->render('modul/tbl_perencanaan_realisasi/tbl_perencanaan_realisasi_update', $this->data);
	}

	/**
	* Update Tbl Perencanaan Realisasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_perencanaan_realisasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Kegiatan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('anggaran', 'Anggaran', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'bidang' => $this->input->post('bidang'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume' => $this->input->post('volume'),
				'lokasi' => $this->input->post('lokasi'),
				'sumber_dana' => $this->input->post('sumber_dana'),
				'anggaran' => $this->input->post('anggaran'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_perencanaan_realisasi = $this->model_tbl_perencanaan_realisasi->change($id, $save_data);

			if ($save_tbl_perencanaan_realisasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_perencanaan_realisasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_realisasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_realisasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Perencanaan Realisasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_perencanaan_realisasi_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_perencanaan_realisasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_perencanaan_realisasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Perencanaan Realisasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_perencanaan_realisasi_view');

		$this->data['tbl_perencanaan_realisasi'] = $this->model_tbl_perencanaan_realisasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Realisasi Pembangunan Detail');
		$this->render('modul/tbl_perencanaan_realisasi/tbl_perencanaan_realisasi_view', $this->data);
	}
	
	/**
	* delete Tbl Perencanaan Realisasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_perencanaan_realisasi = $this->model_tbl_perencanaan_realisasi->find($id);

		
		
		return $this->model_tbl_perencanaan_realisasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_perencanaan_realisasi_export');

		$this->model_tbl_perencanaan_realisasi->export('tbl_perencanaan_realisasi', 'tbl_perencanaan_realisasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_perencanaan_realisasi_export');

		$this->model_tbl_perencanaan_realisasi->pdf('tbl_perencanaan_realisasi', 'tbl_perencanaan_realisasi');
	}
}


/* End of file tbl_perencanaan_realisasi.php */
/* Location: ./application/controllers/Tbl Perencanaan Realisasi.php */