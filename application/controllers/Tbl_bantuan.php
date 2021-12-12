<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Bantuan Controller
*| --------------------------------------------------------------------------
*| Tbl Bantuan site
*|
*/
class Tbl_bantuan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_bantuan');
	}

	/**
	* show all Tbl Bantuans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_bantuan_list');

		$filter = $this->input->get('q');
		$field 	= 'nik';

		$this->data['tbl_bantuans'] = $this->model_tbl_bantuan->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_bantuan_counts'] = $this->model_tbl_bantuan->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_bantuan/index/',
			'total_rows'   => $this->model_tbl_bantuan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tagging Bantuan List');
		$this->render('modul/tbl_bantuan/tbl_bantuan_list', $this->data);
	}
	
	/**
	* Add new tbl_bantuans
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_bantuan_add');

		$this->template->title('Tagging Bantuan New');
		$this->render('modul/tbl_bantuan/tbl_bantuan_add', $this->data);
	}

	/**
	* Add New Tbl Bantuans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_bantuan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Wilayah', 'trim|required');
		$this->form_validation->set_rules('no_kk', 'No.KK', 'trim|required|is_unique[tbl_bantuan.no_kk]');
		$this->form_validation->set_rules('nama_kepala', 'Nama Kepala Keluarga', 'trim|required');
		$this->form_validation->set_rules('pkh', 'PKH', 'trim|required');
		$this->form_validation->set_rules('bpnt', 'BPNT', 'trim|required');
		$this->form_validation->set_rules('blt_dd', 'BLT DD', 'trim|required');
		$this->form_validation->set_rules('bst', 'BST', 'trim|required');
		$this->form_validation->set_rules('created_by', 'Created By', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('creation_date', 'Creation Date', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no_kk' => $this->input->post('no_kk'),
				'nama_kepala' => $this->input->post('nama_kepala'),
				'pkh' => $this->input->post('pkh'),
				'bpnt' => $this->input->post('bpnt'),
				'blt_dd' => $this->input->post('blt_dd'),
				'bst' => $this->input->post('bst'),
				'created_by' => $this->input->post('created_by'),
				'creation_date' => $this->input->post('creation_date'),
			];

			
			$save_tbl_bantuan = $this->model_tbl_bantuan->store($save_data);

			if ($save_tbl_bantuan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_bantuan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_bantuan/edit/' . $save_tbl_bantuan, 'Edit Tbl Bantuan'),
						anchor('tbl_bantuan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_bantuan/edit/' . $save_tbl_bantuan, 'Edit Tbl Bantuan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_bantuan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_bantuan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Bantuans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_bantuan_update');

		$this->data['tbl_bantuan'] = $this->model_tbl_bantuan->find($id);

		$this->template->title('Tagging Bantuan Update');
		$this->render('modul/tbl_bantuan/tbl_bantuan_update', $this->data);
	}

	/**
	* Update Tbl Bantuans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_bantuan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no_kk', 'No.KK', 'trim|required|is_unique[tbl_bantuan.no_kk]');
		$this->form_validation->set_rules('nama_kepala', 'Nama Kepala Keluarga', 'trim|required');
		$this->form_validation->set_rules('pkh', 'PKH', 'trim|required');
		$this->form_validation->set_rules('bpnt', 'BPNT', 'trim|required');
		$this->form_validation->set_rules('blt_dd', 'BLT DD', 'trim|required');
		$this->form_validation->set_rules('bst', 'BST', 'trim|required');
		$this->form_validation->set_rules('last_updated_by', 'Last Updated By', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('last_updated_date', 'Last Updated Date', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'nama_kepala' => $this->input->post('nama_kepala'),
				'pkh' => $this->input->post('pkh'),
				'bpnt' => $this->input->post('bpnt'),
				'blt_dd' => $this->input->post('blt_dd'),
				'bst' => $this->input->post('bst'),
				'last_updated_by' => $this->input->post('last_updated_by'),
				'last_updated_date' => $this->input->post('last_updated_date'),
			];

			
			$save_tbl_bantuan = $this->model_tbl_bantuan->change($id, $save_data);

			if ($save_tbl_bantuan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_bantuan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_bantuan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_bantuan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Bantuans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_bantuan_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_bantuan'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_bantuan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Bantuans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_bantuan_view');

		$this->data['tbl_bantuan'] = $this->model_tbl_bantuan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tagging Bantuan Detail');
		$this->render('modul/tbl_bantuan/tbl_bantuan_view', $this->data);
	}
	
	/**
	* delete Tbl Bantuans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_bantuan = $this->model_tbl_bantuan->find($id);

		
		
		return $this->model_tbl_bantuan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_bantuan_export');

		$this->model_tbl_bantuan->export('tbl_bantuan', 'tbl_bantuan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_bantuan_export');

		$this->model_tbl_bantuan->pdf('tbl_bantuan', 'tbl_bantuan');
	}
}


/* End of file tbl_bantuan.php */
/* Location: ./application/controllers/Tbl Bantuan.php */