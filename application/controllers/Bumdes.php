<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bumdes Controller
*| --------------------------------------------------------------------------
*| Bumdes site
*|
*/
class Bumdes extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bumdes');
	}

	/**
	* show all Bumdess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bumdes_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bumdess'] = $this->model_bumdes->get($filter, $field, $this->limit_page, $offset);
		$this->data['bumdes_counts'] = $this->model_bumdes->count_all($filter, $field);

		$config = [
			'base_url'     => 'bumdes/index/',
			'total_rows'   => $this->model_bumdes->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bumdes List');
		$this->render('modul/bumdes/bumdes_list', $this->data);
	}
	
	/**
	* Add new bumdess
	*
	*/
	public function add()
	{
		$this->is_allowed('bumdes_add');

		$this->template->title('Bumdes New');
		$this->render('modul/bumdes/bumdes_add', $this->data);
	}

	/**
	* Add New Bumdess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bumdes_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_BUMDes', 'Nama BUMDes', 'trim|required|max_length[500]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'periode' => $this->input->post('periode'),
				'jenis_BUMDes' => $this->input->post('jenis_BUMDes'),
				'nama_BUMDes' => $this->input->post('nama_BUMDes'),
				'pengelolah' => $this->input->post('pengelolah'),
				'jabatan' => $this->input->post('jabatan'),
				'tanggal_pendirian' => $this->input->post('tanggal_pendirian'),
				'perdes' => $this->input->post('perdes'),
				'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
				'status' => $this->input->post('status'),
			];

			
			$save_bumdes = $this->model_bumdes->store($save_data);

			if ($save_bumdes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bumdes;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('bumdes/edit/' . $save_bumdes, 'Edit Bumdes'),
						anchor('bumdes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('bumdes/edit/' . $save_bumdes, 'Edit Bumdes')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('bumdes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('bumdes');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bumdess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bumdes_update');

		$this->data['bumdes'] = $this->model_bumdes->find($id);

		$this->template->title('Bumdes Update');
		$this->render('modul/bumdes/bumdes_update', $this->data);
	}

	/**
	* Update Bumdess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bumdes_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_BUMDes', 'Nama BUMDes', 'trim|required|max_length[500]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'periode' => $this->input->post('periode'),
				'jenis_BUMDes' => $this->input->post('jenis_BUMDes'),
				'nama_BUMDes' => $this->input->post('nama_BUMDes'),
				'pengelolah' => $this->input->post('pengelolah'),
				'jabatan' => $this->input->post('jabatan'),
				'tanggal_pendirian' => $this->input->post('tanggal_pendirian'),
				'perdes' => $this->input->post('perdes'),
				'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
				'status' => $this->input->post('status'),
			];

			
			$save_bumdes = $this->model_bumdes->change($id, $save_data);

			if ($save_bumdes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('bumdes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('bumdes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('bumdes');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bumdess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bumdes_delete');

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
            set_message(cclang('has_been_deleted', 'bumdes'), 'success');
        } else {
            set_message(cclang('error_delete', 'bumdes'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bumdess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bumdes_view');

		$this->data['bumdes'] = $this->model_bumdes->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bumdes Detail');
		$this->render('modul/bumdes/bumdes_view', $this->data);
	}
	
	/**
	* delete Bumdess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bumdes = $this->model_bumdes->find($id);

		
		
		return $this->model_bumdes->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bumdes_export');

		$this->model_bumdes->export('bumdes', 'bumdes');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bumdes_export');

		$this->model_bumdes->pdf('bumdes', 'bumdes');
	}
}


/* End of file bumdes.php */
/* Location: ./application/controllers/Bumdes.php */