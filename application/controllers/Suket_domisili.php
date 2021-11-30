<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Suket Domisili Controller
*| --------------------------------------------------------------------------
*| Suket Domisili site
*|
*/
class Suket_domisili extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_suket_domisili');
		$this->load->library('Pdf');
	}

	/**
	* show all Suket Domisilis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('suket_domisili_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suket_domisilis'] = $this->model_suket_domisili->get($filter, $field, $this->limit_page, $offset);
		$this->data['suket_domisili_counts'] = $this->model_suket_domisili->count_all($filter, $field);

		$config = [
			'base_url'     => 'suket_domisili/index/',
			'total_rows'   => $this->model_suket_domisili->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Suket Domisili List');
		$this->render('modul/suket_domisili/suket_domisili_list', $this->data);
	}
	
	/**
	* Add new suket_domisilis
	*
	*/
	public function add()
	{
		$this->is_allowed('suket_domisili_add');

		$this->template->title('Suket Domisili New');
		$this->render('modul/suket_domisili/suket_domisili_add', $this->data);
	}

	/**
	* Add New Suket Domisilis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('suket_domisili_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('no', 'No.Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|max_length[30]');
		$this->form_validation->set_rules('bukti_surat', 'Bukti Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'no' => $this->input->post('no'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'tmpt_lahir' => $this->input->post('tmpt_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'agama' => $this->input->post('agama'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'alamat' => $this->input->post('alamat'),
				'bukti_surat' => $this->input->post('bukti_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_domisili = $this->model_suket_domisili->store($save_data);
			$data = array(
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'surat_keluar_nomor' => $this->input->post('no'),
				'surat_keluar_jenis' => "domisili" ,
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'Nik' => $this->input->post('nik'),
				'suket_id' => $save_suket_domisili
		);
		
		$this->db->insert('surat_keluar', $data);

			if ($save_suket_domisili) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_suket_domisili;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('suket_domisili/edit/' . $save_suket_domisili, 'Edit Suket Domisili'),
						anchor('suret_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('suket_domisili/edit/' . $save_suket_domisili, 'Edit Suket Domisili')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_keluar');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Suket Domisilis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('suket_domisili_update');

		$this->data['suket_domisili'] = $this->model_suket_domisili->find($id);

		$this->template->title('Suket Domisili Update');
		$this->render('modul/suket_domisili/suket_domisili_update', $this->data);
	}

	/**
	* Update Suket Domisilis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('suket_domisili_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('no', 'No.Surat', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|max_length[30]');
		$this->form_validation->set_rules('bukti_surat', 'Bukti Surat', 'trim|required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'no' => $this->input->post('no'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'tmpt_lahir' => $this->input->post('tmpt_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'agama' => $this->input->post('agama'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'alamat' => $this->input->post('alamat'),
				'bukti_surat' => $this->input->post('bukti_surat'),
				'tanggal_surat' => $this->input->post('tanggal_surat'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_suket_domisili = $this->model_suket_domisili->change($id, $save_data);

			if ($save_suket_domisili) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('surat_keluar', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('surat_keluar');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('surat_keluar');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Suket Domisilis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('suket_domisili_delete');

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
            set_message(cclang('has_been_deleted', 'suket_domisili'), 'success');
        } else {
            set_message(cclang('error_delete', 'suket_domisili'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Suket Domisilis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('suket_domisili_view');

		$this->data['suket_domisili'] = $this->model_suket_domisili->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Suket Domisili Detail');
		$this->render('modul/suket_domisili/suket_domisili_view', $this->data);
	}
	
	/**
	* delete Suket Domisilis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$suket_domisili = $this->model_suket_domisili->find($id);

		
		
		return $this->model_suket_domisili->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('suket_domisili_export');

		$this->model_suket_domisili->export('suket_domisili', 'suket_domisili');
	}

	public function cetak($id,$kdwilayah)
	{

		$this->is_allowed('suket_domisili_view');
		$a = db_get_all_data('wilayah',"kd_wilayah=$kdwilayah");
		foreach($a as $as){$kdinduk = $as->kd_induk;}
		$data['cetak'] = $this->model_suket_domisili->cetak($id);
		
		$data['wilayah'] = $this->model_suket_domisili->wilayah($kdwilayah);
		
		$this->load->view('modul/suket_domisili/print_suket_domisili',$data);
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('suket_domisili_export');

		$this->model_suket_domisili->pdf('suket_domisili', 'suket_domisili');
	}
}


/* End of file suket_domisili.php */
/* Location: ./application/controllers/Suket Domisili.php */