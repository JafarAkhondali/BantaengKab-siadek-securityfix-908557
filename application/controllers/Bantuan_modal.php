<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bantuan Modal Controller
*| --------------------------------------------------------------------------
*| Bantuan Modal site
*|
*/
class Bantuan_modal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bantuan_modal');
	}

	/**
	* show all Bantuan Modals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bantuan_modal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bantuan_modals'] = $this->model_bantuan_modal->get($filter, $field, $this->limit_page, $offset);
		$this->data['bantuan_modal_counts'] = $this->model_bantuan_modal->count_all($filter, $field);

		$config = [
			'base_url'     => 'bantuan_modal/index/',
			'total_rows'   => $this->model_bantuan_modal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bantuan Modal List');
		$this->render('modul/bantuan_modal/bantuan_modal_list', $this->data);
	}
	
	/**
	* Add new bantuan_modals
	*
	*/
	public function add()
	{
		$this->is_allowed('bantuan_modal_add');

		$this->template->title('Bantuan Modal New');
		$this->render('modul/bantuan_modal/bantuan_modal_add', $this->data);
	}

	/**
	* Add New Bantuan Modals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bantuan_modal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

	//	$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dusun', 'Dusun', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('perolehan_nilai', 'Perolehan Nilai', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[1000]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'dusun' => $this->input->post('dusun'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_usaha' => $this->input->post('jenis_usaha'),
				'perolehan_nilai' => $this->input->post('perolehan_nilai'),
				'keterangan' => $this->input->post('keterangan'),
				'user_masuk' => $this->input->post('user_masuk'),
				'waktu_masuk' => $this->input->post('waktu_masuk'),
				'user_update' => $this->input->post('user_update'),
				'waktu_upadate' => $this->input->post('waktu_upadate'),
			];

			
			$save_bantuan_modal = $this->model_bantuan_modal->store($save_data);

			if ($save_bantuan_modal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bantuan_modal;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('bantuan_modal/edit/' . $save_bantuan_modal, 'Edit Bantuan Modal'),
						anchor('bantuan_modal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('bantuan_modal/edit/' . $save_bantuan_modal, 'Edit Bantuan Modal')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('bantuan_modal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('bantuan_modal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bantuan Modals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bantuan_modal_update');

		$this->data['bantuan_modal'] = $this->model_bantuan_modal->find($id);

		$this->template->title('Bantuan Modal Update');
		$this->render('modul/bantuan_modal/bantuan_modal_update', $this->data);
	}

	/**
	* Update Bantuan Modals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bantuan_modal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dusun', 'Dusun', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('perolehan_nilai', 'Perolehan Nilai', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[1000]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'dusun' => $this->input->post('dusun'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_usaha' => $this->input->post('jenis_usaha'),
				'perolehan_nilai' => $this->input->post('perolehan_nilai'),
				'keterangan' => $this->input->post('keterangan'),
				'user_masuk' => $this->input->post('user_masuk'),
				'waktu_masuk' => $this->input->post('waktu_masuk'),
				'user_update' => $this->input->post('user_update'),
				'waktu_upadate' => $this->input->post('waktu_upadate'),
			];

			
			$save_bantuan_modal = $this->model_bantuan_modal->change($id, $save_data);

			if ($save_bantuan_modal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('bantuan_modal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('bantuan_modal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('bantuan_modal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bantuan Modals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bantuan_modal_delete');

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
            set_message(cclang('has_been_deleted', 'bantuan_modal'), 'success');
        } else {
            set_message(cclang('error_delete', 'bantuan_modal'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bantuan Modals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bantuan_modal_view');

		$this->data['bantuan_modal'] = $this->model_bantuan_modal->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bantuan Modal Detail');
		$this->render('modul/bantuan_modal/bantuan_modal_view', $this->data);
	}
	
	/**
	* delete Bantuan Modals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bantuan_modal = $this->model_bantuan_modal->find($id);

		
		
		return $this->model_bantuan_modal->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bantuan_modal_export');

		$this->model_bantuan_modal->export('bantuan_modal', 'bantuan_modal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bantuan_modal_export');

		$this->model_bantuan_modal->pdf('bantuan_modal', 'bantuan_modal');
	}
}


/* End of file bantuan_modal.php */
/* Location: ./application/controllers/Bantuan Modal.php */