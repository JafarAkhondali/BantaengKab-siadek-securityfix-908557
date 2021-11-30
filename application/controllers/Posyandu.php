<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Posyandu Controller
*| --------------------------------------------------------------------------
*| Posyandu site
*|
*/
class Posyandu extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_posyandu');
	}

	/**
	* show all Posyandus
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('posyandu_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['posyandus'] = $this->model_posyandu->get($filter, $field, $this->limit_page, $offset);
		$this->data['posyandu_counts'] = $this->model_posyandu->count_all($filter, $field);

		$config = [
			'base_url'     => 'posyandu/index/',
			'total_rows'   => $this->model_posyandu->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Posyandu List');
		$this->render('modul/posyandu/posyandu_list', $this->data);
	}
	
	/**
	* Add new posyandus
	*
	*/
	public function add()
	{
		$this->is_allowed('posyandu_add');

		$this->template->title('Posyandu New');
		$this->render('modul/posyandu/posyandu_add', $this->data);
	}

	/**
	* Add New Posyandus
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('posyandu_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'posyandu_nama' => $this->input->post('posyandu_nama'),
				'alamat' => $this->input->post('alamat'),
			];

			
			$save_posyandu = $this->model_posyandu->store($save_data);

			if ($save_posyandu) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_posyandu;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('posyandu/edit/' . $save_posyandu, 'Edit Posyandu'),
						anchor('posyandu', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('posyandu/edit/' . $save_posyandu, 'Edit Posyandu')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('posyandu');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('posyandu');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Posyandus
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('posyandu_update');

		$this->data['posyandu'] = $this->model_posyandu->find($id);

		$this->template->title('Posyandu Update');
		$this->render('modul/posyandu/posyandu_update', $this->data);
	}

	/**
	* Update Posyandus
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('posyandu_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'posyandu_nama' => $this->input->post('posyandu_nama'),
				'alamat' => $this->input->post('alamat'),
			];

			
			$save_posyandu = $this->model_posyandu->change($id, $save_data);

			if ($save_posyandu) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('posyandu', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('posyandu');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('posyandu');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Posyandus
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('posyandu_delete');

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
            set_message(cclang('has_been_deleted', 'posyandu'), 'success');
        } else {
            set_message(cclang('error_delete', 'posyandu'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Posyandus
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('posyandu_view');

		$this->data['posyandu'] = $this->model_posyandu->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Posyandu Detail');
		$this->render('modul/posyandu/posyandu_view', $this->data);
	}
	
	/**
	* delete Posyandus
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$posyandu = $this->model_posyandu->find($id);

		
		
		return $this->model_posyandu->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('posyandu_export');

		$this->model_posyandu->export('posyandu', 'posyandu');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('posyandu_export');

		$this->model_posyandu->pdf('posyandu', 'posyandu');
	}
}


/* End of file posyandu.php */
/* Location: ./application/controllers/Posyandu.php */