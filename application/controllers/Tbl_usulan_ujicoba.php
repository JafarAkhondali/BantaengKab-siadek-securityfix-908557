<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Usulan Ujicoba Controller
*| --------------------------------------------------------------------------
*| Tbl Usulan Ujicoba site
*|
*/
class Tbl_usulan_ujicoba extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_usulan_ujicoba');
	}

	/**
	* show all Tbl Usulan Ujicobas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_usulan_ujicoba_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tbl_usulan_ujicobas'] = $this->model_tbl_usulan_ujicoba->get($filter, $field, $this->limit_page, $offset);
		$this->data['tbl_usulan_ujicoba_counts'] = $this->model_tbl_usulan_ujicoba->count_all($filter, $field);

		$config = [
			'base_url'     => 'tbl_usulan_ujicoba/index/',
			'total_rows'   => $this->model_tbl_usulan_ujicoba->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tbl Usulan Ujicoba List');
		$this->render('modul/tbl_usulan_ujicoba/tbl_usulan_ujicoba_list', $this->data);
	}
	
	/**
	* Add new tbl_usulan_ujicobas
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_usulan_ujicoba_add');

		$this->template->title('Tbl Usulan Ujicoba New');
		$this->render('modul/tbl_usulan_ujicoba/tbl_usulan_ujicoba_add', $this->data);
	}

	/**
	* Add New Tbl Usulan Ujicobas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_usulan_ujicoba_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('psnoka', 'Psnoka', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('noka', 'Noka', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('jenkel', 'Jenkel', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tgllhr', 'Tgllhr', 'trim|required');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kkno', 'Kkno', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('pisat', 'Pisat', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kdstawin', 'Kdstawin', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('noppk', 'Noppk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmppk', 'Nmppk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('namadati2', 'Namadati2', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmkec', 'Nmkec', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmdesa', 'Nmdesa', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'psnoka' => $this->input->post('psnoka'),
				'noka' => $this->input->post('noka'),
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgllhr' => $this->input->post('tgllhr'),
				'nik' => $this->input->post('nik'),
				'kkno' => $this->input->post('kkno'),
				'pisat' => $this->input->post('pisat'),
				'kdstawin' => $this->input->post('kdstawin'),
				'noppk' => $this->input->post('noppk'),
				'nmppk' => $this->input->post('nmppk'),
				'alamat' => $this->input->post('alamat'),
				'namadati2' => $this->input->post('namadati2'),
				'nmkec' => $this->input->post('nmkec'),
				'nmdesa' => $this->input->post('nmdesa'),
				'status' => $this->input->post('status'),
			];

			
			$save_tbl_usulan_ujicoba = $this->model_tbl_usulan_ujicoba->store($save_data);

			if ($save_tbl_usulan_ujicoba) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_usulan_ujicoba;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_usulan_ujicoba/edit/' . $save_tbl_usulan_ujicoba, 'Edit Tbl Usulan Ujicoba'),
						anchor('tbl_usulan_ujicoba', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_usulan_ujicoba/edit/' . $save_tbl_usulan_ujicoba, 'Edit Tbl Usulan Ujicoba')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_usulan_ujicoba');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_usulan_ujicoba');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Usulan Ujicobas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_usulan_ujicoba_update');

		$this->data['tbl_usulan_ujicoba'] = $this->model_tbl_usulan_ujicoba->find($id);

		$this->template->title('Tbl Usulan Ujicoba Update');
		$this->render('modul/tbl_usulan_ujicoba/tbl_usulan_ujicoba_update', $this->data);
	}

	/**
	* Update Tbl Usulan Ujicobas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_usulan_ujicoba_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('psnoka', 'Psnoka', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('noka', 'Noka', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('jenkel', 'Jenkel', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tgllhr', 'Tgllhr', 'trim|required');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kkno', 'Kkno', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('pisat', 'Pisat', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kdstawin', 'Kdstawin', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('noppk', 'Noppk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmppk', 'Nmppk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('namadati2', 'Namadati2', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmkec', 'Nmkec', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nmdesa', 'Nmdesa', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'psnoka' => $this->input->post('psnoka'),
				'noka' => $this->input->post('noka'),
				'nama' => $this->input->post('nama'),
				'jenkel' => $this->input->post('jenkel'),
				'tgllhr' => $this->input->post('tgllhr'),
				'nik' => $this->input->post('nik'),
				'kkno' => $this->input->post('kkno'),
				'pisat' => $this->input->post('pisat'),
				'kdstawin' => $this->input->post('kdstawin'),
				'noppk' => $this->input->post('noppk'),
				'nmppk' => $this->input->post('nmppk'),
				'alamat' => $this->input->post('alamat'),
				'namadati2' => $this->input->post('namadati2'),
				'nmkec' => $this->input->post('nmkec'),
				'nmdesa' => $this->input->post('nmdesa'),
				'status' => $this->input->post('status'),
			];

			
			$save_tbl_usulan_ujicoba = $this->model_tbl_usulan_ujicoba->change($id, $save_data);

			if ($save_tbl_usulan_ujicoba) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_usulan_ujicoba', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_usulan_ujicoba');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_usulan_ujicoba');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Usulan Ujicobas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_usulan_ujicoba_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_usulan_ujicoba'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_usulan_ujicoba'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Usulan Ujicobas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_usulan_ujicoba_view');

		$this->data['tbl_usulan_ujicoba'] = $this->model_tbl_usulan_ujicoba->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tbl Usulan Ujicoba Detail');
		$this->render('modul/tbl_usulan_ujicoba/tbl_usulan_ujicoba_view', $this->data);
	}
	
	/**
	* delete Tbl Usulan Ujicobas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_usulan_ujicoba = $this->model_tbl_usulan_ujicoba->find($id);

		
		
		return $this->model_tbl_usulan_ujicoba->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_usulan_ujicoba_export');

		$this->model_tbl_usulan_ujicoba->export('tbl_usulan_ujicoba', 'tbl_usulan_ujicoba');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_usulan_ujicoba_export');

		$this->model_tbl_usulan_ujicoba->pdf('tbl_usulan_ujicoba', 'tbl_usulan_ujicoba');
	}
}


/* End of file tbl_usulan_ujicoba.php */
/* Location: ./application/controllers/Tbl Usulan Ujicoba.php */