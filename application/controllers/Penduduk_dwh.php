<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Penduduk Dwh Controller
*| --------------------------------------------------------------------------
*| Penduduk Dwh site
*|
*/
class Penduduk_dwh extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_penduduk_dwh');
	}

	/**
	* show all Penduduk Dwhs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('penduduk_dwh_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['penduduk_dwhs'] = $this->model_penduduk_dwh->get($filter, $field, $this->limit_page, $offset);
		$this->data['penduduk_dwh_counts'] = $this->model_penduduk_dwh->count_all($filter, $field);

		$config = [
			'base_url'     => 'penduduk_dwh/index/',
			'total_rows'   => $this->model_penduduk_dwh->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('KEPENDUDUKAN DWH List');
		$this->render('modul/penduduk_dwh/penduduk_dwh_list', $this->data);
	}
	
	
	
	/**
	* Add new penduduk_dwhs
	*
	*/
	public function add()
	{
		$this->is_allowed('penduduk_dwh_add');

		$this->template->title('KEPENDUDUKAN DWH New');
		$this->render('modul/penduduk_dwh/penduduk_dwh_add', $this->data);
	}

	/**
	* Add New Penduduk Dwhs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('penduduk_dwh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_kab', 'Kd Kab', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kd_kec', 'Kd Kec', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('Nama_Ibu', 'Nama Ibu', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama_krt', 'Nama Krt', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_kab' => $this->input->post('kd_kab'),
				'kd_kec' => $this->input->post('kd_kec'),
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'no_kk' => $this->input->post('no_kk'),
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'Nama_Ibu' => $this->input->post('Nama_Ibu'),
				'nama_krt' => $this->input->post('nama_krt'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
			];

			
			$save_penduduk_dwh = $this->model_penduduk_dwh->store($save_data);

			if ($save_penduduk_dwh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_penduduk_dwh;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('penduduk_dwh/edit/' . $save_penduduk_dwh, 'Edit Penduduk Dwh'),
						anchor('penduduk_dwh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('penduduk_dwh/edit/' . $save_penduduk_dwh, 'Edit Penduduk Dwh')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk_dwh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk_dwh');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Penduduk Dwhs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('penduduk_dwh_update');

		$this->data['penduduk_dwh'] = $this->model_penduduk_dwh->find($id);

		$this->template->title('KEPENDUDUKAN DWH Update');
		$this->render('modul/penduduk_dwh/penduduk_dwh_update', $this->data);
	}

	/**
	* Update Penduduk Dwhs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('penduduk_dwh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kd_kab', 'Kd Kab', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kd_kec', 'Kd Kec', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('Nama_Ibu', 'Nama Ibu', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('nama_krt', 'Nama Krt', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_kab' => $this->input->post('kd_kab'),
				'kd_kec' => $this->input->post('kd_kec'),
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'no_kk' => $this->input->post('no_kk'),
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'Nama_Ibu' => $this->input->post('Nama_Ibu'),
				'nama_krt' => $this->input->post('nama_krt'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
			];

			
			$save_penduduk_dwh = $this->model_penduduk_dwh->change($id, $save_data);

			if ($save_penduduk_dwh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('penduduk_dwh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk_dwh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk_dwh');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Penduduk Dwhs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('penduduk_dwh_delete');

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
            set_message(cclang('has_been_deleted', 'penduduk_dwh'), 'success');
        } else {
            set_message(cclang('error_delete', 'penduduk_dwh'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Penduduk Dwhs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('penduduk_dwh_view');

		$this->data['penduduk_dwh'] = $this->model_penduduk_dwh->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('KEPENDUDUKAN DWH Detail');
		$this->render('modul/penduduk_dwh/penduduk_dwh_view', $this->data);
	}
	
	/**
	* delete Penduduk Dwhs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$penduduk_dwh = $this->model_penduduk_dwh->find($id);

		
		
		return $this->model_penduduk_dwh->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('penduduk_dwh_export');

		$this->model_penduduk_dwh->export('penduduk_dwh', 'penduduk_dwh');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('penduduk_dwh_export');

		$this->model_penduduk_dwh->pdf('penduduk_dwh', 'penduduk_dwh');
	}
}


/* End of file penduduk_dwh.php */
/* Location: ./application/controllers/Penduduk Dwh.php */