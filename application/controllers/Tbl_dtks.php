<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Dtks Controller
*| --------------------------------------------------------------------------
*| Tbl Dtks site
*|
*/
class Tbl_dtks extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_dtks');
	}

	/**
	* show all Tbl Dtkss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_dtks_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_dtkss'] = $this->model_tbl_dtks->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_dtks_counts'] = $this->model_tbl_dtks->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_dtks/index/',
			'total_rows'   => $this->model_tbl_dtks->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Dtks List');
		$this->render('modul/tbl_dtks/tbl_dtks_list', $this->data);
	}
	
	/**
	* Add new tbl_dtkss
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_dtks_add');

		$this->template->title('Tbl Dtks New');
		$this->render('modul/tbl_dtks/tbl_dtks_add', $this->data);
	}

	/**
	* Add New Tbl Dtkss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_dtks_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('prop', 'Prop', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kab', 'Kab', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kec', 'Kec', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('des', 'Des', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]is_unique[tbl_dtks.nik]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('tmp_lahir', 'Tmp Lahir', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jns_kelamin', 'Jns Kelamin', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'prop' => $this->input->post('prop'),
				'kab' => $this->input->post('kab'),
				'kec' => $this->input->post('kec'),
				'des' => $this->input->post('des'),
				'alamat' => $this->input->post('alamat'),
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tmp_lahir' => $this->input->post('tmp_lahir'),
				'jns_kelamin' => $this->input->post('jns_kelamin'),
			];

			
			$save_tbl_dtks = $this->model_tbl_dtks->store($save_data);

			if ($save_tbl_dtks) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_dtks;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_dtks/edit/' . $save_tbl_dtks, 'Edit Tbl Dtks'),
						anchor('tbl_dtks', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_dtks/edit/' . $save_tbl_dtks, 'Edit Tbl Dtks')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_dtks');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_dtks');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Dtkss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_dtks_update');

		$this->data['tbl_dtks'] = $this->model_tbl_dtks->find($id);

		$this->template->title('Tbl Dtks Update');
		$this->render('modul/tbl_dtks/tbl_dtks_update', $this->data);
	}

	/**
	* Update Tbl Dtkss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_dtks_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('prop', 'Prop', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kab', 'Kab', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kec', 'Kec', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('des', 'Des', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[255]|is_unique[tbl_dtks.nik]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('tmp_lahir', 'Tmp Lahir', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jns_kelamin', 'Jns Kelamin', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'prop' => $this->input->post('prop'),
				'kab' => $this->input->post('kab'),
				'kec' => $this->input->post('kec'),
				'des' => $this->input->post('des'),
				'alamat' => $this->input->post('alamat'),
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tmp_lahir' => $this->input->post('tmp_lahir'),
				'jns_kelamin' => $this->input->post('jns_kelamin'),
			];

			
			$save_tbl_dtks = $this->model_tbl_dtks->change($id, $save_data);

			if ($save_tbl_dtks) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_dtks', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_dtks');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_dtks');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Dtkss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_dtks_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_dtks'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_dtks'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Dtkss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_dtks_view');

		$this->data['tbl_dtks'] = $this->model_tbl_dtks->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Dtks Detail');
		$this->render('modul/tbl_dtks/tbl_dtks_view', $this->data);
	}
	
	/**
	* delete Tbl Dtkss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_dtks = $this->model_tbl_dtks->find($id);

		
		
		return $this->model_tbl_dtks->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_dtks_export');

		$this->model_tbl_dtks->export('tbl_dtks', 'tbl_dtks');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_dtks_export');

		$this->model_tbl_dtks->pdf('tbl_dtks', 'tbl_dtks');
	}
}


/* End of file tbl_dtks.php */
/* Location: ./application/controllers/Tbl Dtks.php */