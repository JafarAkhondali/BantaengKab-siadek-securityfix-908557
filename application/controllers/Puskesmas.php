<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Puskesmas Controller
*| --------------------------------------------------------------------------
*| Puskesmas site
*|
*/
class Puskesmas extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_puskesmas');
	}

	/**
	* show all Puskesmass
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('puskesmas_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['puskesmass'] = $this->model_puskesmas->get($filter, $field, $this->limit_page, $offset);
		$this->data['puskesmas_counts'] = $this->model_puskesmas->count_all($filter, $field);

		$config = [
			'base_url'     => 'puskesmas/index/',
			'total_rows'   => $this->model_puskesmas->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Puskesmas List');
		$this->render('modul/puskesmas/puskesmas_list', $this->data);
	}
	
	/**
	* Add new puskesmass
	*
	*/
	public function add()
	{
		$this->is_allowed('puskesmas_add');

		$this->template->title('Puskesmas New');
		$this->render('modul/puskesmas/puskesmas_add', $this->data);
	}

	/**
	* Add New Puskesmass
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('puskesmas_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_puskesmas', 'Nama Puskesmas', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => get_user_data('kd_wilayah'),
				'nama_puskesmas' => $this->input->post('nama_puskesmas'),
				'alamat' => $this->input->post('alamat'),
			];

			
			$save_puskesmas = $this->model_puskesmas->store($save_data);

			if ($save_puskesmas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_puskesmas;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('puskesmas/edit/' . $save_puskesmas, 'Edit Puskesmas'),
						anchor('puskesmas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('puskesmas/edit/' . $save_puskesmas, 'Edit Puskesmas')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('puskesmas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('puskesmas');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Puskesmass
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('puskesmas_update');

		$this->data['puskesmas'] = $this->model_puskesmas->find($id);

		$this->template->title('Puskesmas Update');
		$this->render('modul/puskesmas/puskesmas_update', $this->data);
	}

	/**
	* Update Puskesmass
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('puskesmas_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_puskesmas', 'Nama Puskesmas', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_puskesmas' => $this->input->post('nama_puskesmas'),
				'alamat' => $this->input->post('alamat'),
			];

			
			$save_puskesmas = $this->model_puskesmas->change($id, $save_data);

			if ($save_puskesmas) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('puskesmas', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('puskesmas');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('puskesmas');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Puskesmass
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('puskesmas_delete');

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
            set_message(cclang('has_been_deleted', 'puskesmas'), 'success');
        } else {
            set_message(cclang('error_delete', 'puskesmas'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Puskesmass
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('puskesmas_view');

		$this->data['puskesmas'] = $this->model_puskesmas->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Puskesmas Detail');
		$this->render('modul/puskesmas/puskesmas_view', $this->data);
	}
	
	/**
	* delete Puskesmass
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$puskesmas = $this->model_puskesmas->find($id);

		
		
		return $this->model_puskesmas->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('puskesmas_export');

		$this->model_puskesmas->export('puskesmas', 'puskesmas');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('puskesmas_export');

		$this->model_puskesmas->pdf('puskesmas', 'puskesmas');
	}
}


/* End of file puskesmas.php */
/* Location: ./application/controllers/Puskesmas.php */