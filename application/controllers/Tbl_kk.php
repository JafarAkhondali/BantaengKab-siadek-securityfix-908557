<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Kk Controller
*| --------------------------------------------------------------------------
*| Tbl Kk site
*|
*/
class Tbl_kk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_kk');
	}

	/**
	* show all Tbl Kks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_kk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_kks'] = $this->model_tbl_kk->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_kk_counts'] = $this->model_tbl_kk->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_kk/index/',
			'total_rows'   => $this->model_tbl_kk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Kk List');
		$this->render('modul/tbl_kk/tbl_kk_list', $this->data);
	}
	
	/**
	* Add new tbl_kks
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_kk_add');

		$this->template->title('Tbl Kk New');
		$this->render('modul/tbl_kk/tbl_kk_add', $this->data);
	}

	/**
	* Add New Tbl Kks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_kk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required');
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('kepala_keluarga', 'Kepala Keluarga', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'alamat' => $this->input->post('alamat'),
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'kepala_keluarga' => $this->input->post('kepala_keluarga'),
			];

			
			$save_tbl_kk = $this->model_tbl_kk->store($save_data);

			if ($save_tbl_kk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_kk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_kk/edit/' . $save_tbl_kk, 'Edit Tbl Kk'),
						anchor('tbl_kk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_kk/edit/' . $save_tbl_kk, 'Edit Tbl Kk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_kk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_kk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Kks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_kk_update');

		$this->data['tbl_kk'] = $this->model_tbl_kk->find($id);

		$this->template->title('Tbl Kk Update');
		$this->render('modul/tbl_kk/tbl_kk_update', $this->data);
	}

	/**
	* Update Tbl Kks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_kk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required');
		$this->form_validation->set_rules('kepala_keluarga', 'Kepala Keluarga', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no_kk' => $this->input->post('no_kk'),
				'alamat' => $this->input->post('alamat'),
				'kepala_keluarga' => $this->input->post('kepala_keluarga'),
			];

			
			$save_tbl_kk = $this->model_tbl_kk->change($id, $save_data);

			if ($save_tbl_kk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_kk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_kk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_kk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Kks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_kk_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_kk'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_kk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Kks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_kk_view');

		$this->data['tbl_kk'] = $this->model_tbl_kk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Kk Detail');
		$this->render('modul/tbl_kk/tbl_kk_view', $this->data);
	}
	
	/**
	* delete Tbl Kks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_kk = $this->model_tbl_kk->find($id);

		
		
		return $this->model_tbl_kk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_kk_export');

		$this->model_tbl_kk->export('tbl_kk', 'tbl_kk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_kk_export');

		$this->model_tbl_kk->pdf('tbl_kk', 'tbl_kk');
	}
}


/* End of file tbl_kk.php */
/* Location: ./application/controllers/Tbl Kk.php */