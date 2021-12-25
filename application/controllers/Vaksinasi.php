<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Vaksinasi Controller
*| --------------------------------------------------------------------------
*| Vaksinasi site
*|
*/
class Vaksinasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_vaksinasi');
	}

	/**
	* show all Vaksinasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('vaksinasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');


		$this->data['vaksinasis'] = $this->model_vaksinasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['vaksinasi_counts'] = $this->model_vaksinasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'vaksinasi/index/',
			'total_rows'   => $this->model_vaksinasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Vaksinasi List');
		$this->render('modul/vaksinasi/vaksinasi_list', $this->data);
	}
	
	/**
	* Add new vaksinasis
	*
	*/
	public function add()
	{
		$this->is_allowed('vaksinasi_add');

		$this->template->title('Vaksinasi New');
		$this->render('modul/vaksinasi/vaksinasi_add', $this->data);
	}

	/**
	* Add New Vaksinasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('vaksinasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kl_usia', 'Kelompok Usia', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('dosis', 'Dosis', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jenis_vaksin', 'Jenis Vaksin', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('faskes', 'Faskes', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tiket', 'Tiket', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'kl_usia' => $this->input->post('kl_usia'),
				'dosis' => $this->input->post('dosis'),
				'jenis_vaksin' => $this->input->post('jenis_vaksin'),
				'faskes' => $this->input->post('faskes'),
				'tiket' => $this->input->post('tiket'),
				'tanggal' => $this->input->post('tanggal'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_vaksinasi = $this->model_vaksinasi->store($save_data);

			if ($save_vaksinasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_vaksinasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('vaksinasi/edit/' . $save_vaksinasi, 'Edit Vaksinasi'),
						anchor('vaksinasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('vaksinasi/edit/' . $save_vaksinasi, 'Edit Vaksinasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('vaksinasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('vaksinasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Vaksinasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('vaksinasi_update');

		$this->data['vaksinasi'] = $this->model_vaksinasi->find($id);

		$this->template->title('Vaksinasi Update');
		$this->render('modul/vaksinasi/vaksinasi_update', $this->data);
	}

	/**
	* Update Vaksinasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('vaksinasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dosis', 'Dosis', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jenis_vaksin', 'Jenis Vaksin', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('faskes', 'Faskes', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tiket', 'Tiket', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'dosis' => $this->input->post('dosis'),
				'jenis_vaksin' => $this->input->post('jenis_vaksin'),
				'faskes' => $this->input->post('faskes'),
				'tiket' => $this->input->post('tiket'),
				'tanggal' => $this->input->post('tanggal'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_vaksinasi = $this->model_vaksinasi->change($id, $save_data);

			if ($save_vaksinasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('vaksinasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('vaksinasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('vaksinasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Vaksinasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('vaksinasi_delete');

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
            set_message(cclang('has_been_deleted', 'vaksinasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'vaksinasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Vaksinasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('vaksinasi_view');

		$this->data['vaksinasi'] = $this->model_vaksinasi->join_avaiable()->filter_avaiable()->find($id);
		$this->template->title('Vaksinasi Detail');
		$this->render('modul/vaksinasi/vaksinasi_view', $this->data);
	}
	
	/**
	* delete Vaksinasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$vaksinasi = $this->model_vaksinasi->find($id);

		
		
		return $this->model_vaksinasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('vaksinasi_export');

		$this->model_vaksinasi->export('vaksinasi', 'vaksinasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('vaksinasi_export');

		$this->model_vaksinasi->pdf('vaksinasi', 'vaksinasi');
	}
}


/* End of file vaksinasi.php */
/* Location: ./application/controllers/Vaksinasi.php */