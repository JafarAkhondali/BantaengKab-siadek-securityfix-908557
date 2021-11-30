<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Disabilitas Controller
*| --------------------------------------------------------------------------
*| Tbl Disabilitas site
*|
*/
class Tbl_disabilitas extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_disabilitas');
	}

	/**
	* show all Tbl Disabilitass
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_disabilitas_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_disabilitass'] = $this->model_tbl_disabilitas->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_disabilitas_counts'] = $this->model_tbl_disabilitas->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_disabilitas/index/',
			'total_rows'   => $this->model_tbl_disabilitas->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Disabilitas Dan Rentan List');
		$this->render('modul/tbl_disabilitas/tbl_disabilitas_list', $this->data);
	}
	
	/**
	* Add new tbl_disabilitass
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_disabilitas_add');

		$this->template->title('Data Disabilitas Dan Rentan New');
		$this->render('modul/tbl_disabilitas/tbl_disabilitas_add', $this->data);
	}

	/**
	* Add New Tbl Disabilitass
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_disabilitas_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Wilayah', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|is_unique[tbl_disabilitas.nik]');
		$this->form_validation->set_rules('disabilitas', 'Disabilatas', 'trim|required');
		$this->form_validation->set_rules('rentan', 'Rentan', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'disabilitas' => $this->input->post('disabilitas'),
				'rentan' => $this->input->post('rentan'),
				'keterangan' => $this->input->post('keterangan'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_disabilitas = $this->model_tbl_disabilitas->store($save_data);

			if ($save_tbl_disabilitas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_disabilitas;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_disabilitas/edit/' . $save_tbl_disabilitas, 'Edit Tbl Disabilitas'),
						anchor('tbl_disabilitas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_disabilitas/edit/' . $save_tbl_disabilitas, 'Edit Tbl Disabilitas')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_disabilitas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_disabilitas');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Disabilitass
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_disabilitas_update');

		$this->data['tbl_disabilitas'] = $this->model_tbl_disabilitas->find($id);

		$this->template->title('Data Disabilitas Dan Rentan Update');
		$this->render('modul/tbl_disabilitas/tbl_disabilitas_update', $this->data);
	}

	/**
	* Update Tbl Disabilitass
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_disabilitas_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|is_unique[tbl_disabilitas.nik]');
		$this->form_validation->set_rules('disabilitas', 'Disabilatas', 'trim|required');
		$this->form_validation->set_rules('rentan', 'Rentan', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'disabilitas' => $this->input->post('disabilitas'),
				'rentan' => $this->input->post('rentan'),
				'keterangan' => $this->input->post('keterangan'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_disabilitas = $this->model_tbl_disabilitas->change($id, $save_data);

			if ($save_tbl_disabilitas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_disabilitas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_disabilitas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_disabilitas');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Disabilitass
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_disabilitas_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_disabilitas'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_disabilitas'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Disabilitass
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_disabilitas_view');

		$this->data['tbl_disabilitas'] = $this->model_tbl_disabilitas->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data Disabilitas Dan Rentan Detail');
		$this->render('modul/tbl_disabilitas/tbl_disabilitas_view', $this->data);
	}
	
	/**
	* delete Tbl Disabilitass
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_disabilitas = $this->model_tbl_disabilitas->find($id);

		
		
		return $this->model_tbl_disabilitas->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_disabilitas_export');

		$this->model_tbl_disabilitas->export('tbl_disabilitas', 'tbl_disabilitas');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_disabilitas_export');

		$this->model_tbl_disabilitas->pdf('tbl_disabilitas', 'tbl_disabilitas');
	}
}


/* End of file tbl_disabilitas.php */
/* Location: ./application/controllers/Tbl Disabilitas.php */