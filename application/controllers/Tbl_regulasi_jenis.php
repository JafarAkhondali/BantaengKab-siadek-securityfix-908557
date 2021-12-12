<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Regulasi Jenis Controller
*| --------------------------------------------------------------------------
*| Tbl Regulasi Jenis site
*|
*/
class Tbl_regulasi_jenis extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_regulasi_jenis');
	}

	/**
	* show all Tbl Regulasi Jeniss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_regulasi_jenis_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_regulasi_jeniss'] = $this->model_tbl_regulasi_jenis->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_regulasi_jenis_counts'] = $this->model_tbl_regulasi_jenis->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_regulasi_jenis/index/',
			'total_rows'   => $this->model_tbl_regulasi_jenis->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Regulasi Jenis List');
		$this->render('modul/tbl_regulasi_jenis/tbl_regulasi_jenis_list', $this->data);
	}
	
	/**
	* Add new tbl_regulasi_jeniss
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_regulasi_jenis_add');

		$this->template->title('Tbl Regulasi Jenis New');
		$this->render('modul/tbl_regulasi_jenis/tbl_regulasi_jenis_add', $this->data);
	}

	/**
	* Add New Tbl Regulasi Jeniss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_regulasi_jenis_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('regulasi_jns_kode', 'Regulasi Jns Kode', 'trim|required');
		$this->form_validation->set_rules('regulasi_jns_nama', 'Regulasi Jns Nama', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'regulasi_jns_kode' => $this->input->post('regulasi_jns_kode'),
				'regulasi_jns_nama' => $this->input->post('regulasi_jns_nama'),
			];

			
			$save_tbl_regulasi_jenis = $this->model_tbl_regulasi_jenis->store($save_data);

			if ($save_tbl_regulasi_jenis) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_regulasi_jenis;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_regulasi_jenis/edit/' . $save_tbl_regulasi_jenis, 'Edit Tbl Regulasi Jenis'),
						anchor('tbl_regulasi_jenis', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_regulasi_jenis/edit/' . $save_tbl_regulasi_jenis, 'Edit Tbl Regulasi Jenis')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_regulasi_jenis');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_regulasi_jenis');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Regulasi Jeniss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_regulasi_jenis_update');

		$this->data['tbl_regulasi_jenis'] = $this->model_tbl_regulasi_jenis->find($id);

		$this->template->title('Tbl Regulasi Jenis Update');
		$this->render('modul/tbl_regulasi_jenis/tbl_regulasi_jenis_update', $this->data);
	}

	/**
	* Update Tbl Regulasi Jeniss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_regulasi_jenis_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('regulasi_jns_kode', 'Regulasi Jns Kode', 'trim|required');
		$this->form_validation->set_rules('regulasi_jns_nama', 'Regulasi Jns Nama', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'regulasi_jns_kode' => $this->input->post('regulasi_jns_kode'),
				'regulasi_jns_nama' => $this->input->post('regulasi_jns_nama'),
			];

			
			$save_tbl_regulasi_jenis = $this->model_tbl_regulasi_jenis->change($id, $save_data);

			if ($save_tbl_regulasi_jenis) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_regulasi_jenis', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_regulasi_jenis');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_regulasi_jenis');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Regulasi Jeniss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_regulasi_jenis_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_regulasi_jenis'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_regulasi_jenis'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Regulasi Jeniss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_regulasi_jenis_view');

		$this->data['tbl_regulasi_jenis'] = $this->model_tbl_regulasi_jenis->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Regulasi Jenis Detail');
		$this->render('modul/tbl_regulasi_jenis/tbl_regulasi_jenis_view', $this->data);
	}
	
	/**
	* delete Tbl Regulasi Jeniss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_regulasi_jenis = $this->model_tbl_regulasi_jenis->find($id);

		
		
		return $this->model_tbl_regulasi_jenis->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_regulasi_jenis_export');

		$this->model_tbl_regulasi_jenis->export('tbl_regulasi_jenis', 'tbl_regulasi_jenis');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_regulasi_jenis_export');

		$this->model_tbl_regulasi_jenis->pdf('tbl_regulasi_jenis', 'tbl_regulasi_jenis');
	}
}


/* End of file tbl_regulasi_jenis.php */
/* Location: ./application/controllers/Tbl Regulasi Jenis.php */