<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Setup Potensi Controller
*| --------------------------------------------------------------------------
*| Setup Potensi site
*|
*/
class Setup_potensi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_setup_potensi');
	}

	/**
	* show all Setup Potensis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('setup_potensi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['setup_potensis'] = $this->model_setup_potensi->get($filter, $field, $this->limit_page, $offset);
		$this->data['setup_potensi_counts'] = $this->model_setup_potensi->count_all($filter, $field);

		$config = [
			'base_url'     => 'setup_potensi/index/',
			'total_rows'   => $this->model_setup_potensi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Setup Potensi List');
		$this->render('modul/setup_potensi/setup_potensi_list', $this->data);
	}
	
	/**
	* Add new setup_potensis
	*
	*/
	public function add()
	{
		$this->is_allowed('setup_potensi_add');

		$this->template->title('Setup Potensi New');
		$this->render('modul/setup_potensi/setup_potensi_add', $this->data);
	}

	/**
	* Add New Setup Potensis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('setup_potensi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama' => $this->input->post('nama'),
			];

			
			$save_setup_potensi = $this->model_setup_potensi->store($save_data);

			if ($save_setup_potensi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_setup_potensi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('setup_potensi/edit/' . $save_setup_potensi, 'Edit Setup Potensi'),
						anchor('setup_potensi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('setup_potensi/edit/' . $save_setup_potensi, 'Edit Setup Potensi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('setup_potensi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('setup_potensi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Setup Potensis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('setup_potensi_update');

		$this->data['setup_potensi'] = $this->model_setup_potensi->find($id);

		$this->template->title('Setup Potensi Update');
		$this->render('modul/setup_potensi/setup_potensi_update', $this->data);
	}

	/**
	* Update Setup Potensis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('setup_potensi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama' => $this->input->post('nama'),
			];

			
			$save_setup_potensi = $this->model_setup_potensi->change($id, $save_data);

			if ($save_setup_potensi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('setup_potensi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('setup_potensi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('setup_potensi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Setup Potensis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('setup_potensi_delete');

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
            set_message(cclang('has_been_deleted', 'setup_potensi'), 'success');
        } else {
            set_message(cclang('error_delete', 'setup_potensi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Setup Potensis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('setup_potensi_view');

		$this->data['setup_potensi'] = $this->model_setup_potensi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Setup Potensi Detail');
		$this->render('modul/setup_potensi/setup_potensi_view', $this->data);
	}
	
	/**
	* delete Setup Potensis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$setup_potensi = $this->model_setup_potensi->find($id);

		
		
		return $this->model_setup_potensi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('setup_potensi_export');

		$this->model_setup_potensi->export('setup_potensi', 'setup_potensi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('setup_potensi_export');

		$this->model_setup_potensi->pdf('setup_potensi', 'setup_potensi');
	}
}


/* End of file setup_potensi.php */
/* Location: ./application/controllers/Setup Potensi.php */