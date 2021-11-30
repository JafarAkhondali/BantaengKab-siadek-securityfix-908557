<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Rencana Controller
*| --------------------------------------------------------------------------
*| Tbl Perencanaan Rencana site
*|
*/
class Tbl_perencanaan_rencana extends Admin	
{
	private $filename = "import_data"; // Kita tentukan nama filenya
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tbl_perencanaan_rencana');
	}

	/**
	* show all Tbl Perencanaan Rencanas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tbl_perencanaan_rencana_list');

		$this->data['tbl_perencanaan_rencana_pendapatans'] = $this->model_tbl_perencanaan_rencana->get_pendapatan();
		$this->data['tbl_perencanaan_rencana_count_pendapatans'] = $this->model_tbl_perencanaan_rencana->count_all_pendapatan();
		$this->data['tbl_perencanaan_rencana_belanjas'] = $this->model_tbl_perencanaan_rencana->get_belanja();
		$this->data['tbl_perencanaan_rencana_count_belanjas'] = $this->model_tbl_perencanaan_rencana->count_all_belanja();
		$this->data['tbl_perencanaan_rencana_pembiayaans'] = $this->model_tbl_perencanaan_rencana->get_pembiayaan();
		$this->data['tbl_perencanaan_rencana_count_pembiayaans'] = $this->model_tbl_perencanaan_rencana->count_all_pembiayaan();

		$this->template->title('Rencana Pembangunan List');
		$this->render('modul/tbl_perencanaan_rencana/tbl_perencanaan_rencana_list', $this->data);
	}
	
	/**
	* Add new tbl_perencanaan_rencanas
	*
	*/
	public function add()
	{
		$this->is_allowed('tbl_perencanaan_rencana_add');

		$this->template->title('Rencana Pembangunan New');
		$this->render('modul/tbl_perencanaan_rencana/tbl_perencanaan_rencana_add', $this->data);
	}

	/**
	* Add New Tbl Perencanaan Rencanas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tbl_perencanaan_rencana_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bidang', 'Bidang', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Kegiatan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'trim|required');
		$this->form_validation->set_rules('anggaran', 'Anggaran', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'bidang' => $this->input->post('bidang'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume' => $this->input->post('volume'),
				'lokasi' => $this->input->post('lokasi'),
				'sumber_dana' => $this->input->post('sumber_dana'),
				'anggaran' => $this->input->post('anggaran'),
				'created_by' => get_user_data('username'),
				'creation_date' => date('Y-m-d H:i:s'),
			];

			
			$save_tbl_perencanaan_rencana = $this->model_tbl_perencanaan_rencana->store($save_data);

			if ($save_tbl_perencanaan_rencana) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tbl_perencanaan_rencana;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('tbl_perencanaan_rencana/edit/' . $save_tbl_perencanaan_rencana, 'Edit Tbl Perencanaan Rencana'),
						anchor('tbl_perencanaan_rencana', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('tbl_perencanaan_rencana/edit/' . $save_tbl_perencanaan_rencana, 'Edit Tbl Perencanaan Rencana')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_rencana');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_rencana');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tbl Perencanaan Rencanas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tbl_perencanaan_rencana_update');

		$this->data['tbl_perencanaan_rencana'] = $this->model_tbl_perencanaan_rencana->find($id);

		$this->template->title('Rencana Pembangunan Update');
		$this->render('modul/tbl_perencanaan_rencana/tbl_perencanaan_rencana_update', $this->data);
	}

	/**
	* Update Tbl Perencanaan Rencanas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tbl_perencanaan_rencana_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bidang', 'Bidang', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'Kegiatan', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'trim|required');
		$this->form_validation->set_rules('anggaran', 'Anggaran', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bidang' => $this->input->post('bidang'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume' => $this->input->post('volume'),
				'lokasi' => $this->input->post('lokasi'),
				'sumber_dana' => $this->input->post('sumber_dana'),
				'anggaran' => $this->input->post('anggaran'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => get_user_data('username'),
			];

			
			$save_tbl_perencanaan_rencana = $this->model_tbl_perencanaan_rencana->change($id, $save_data);

			if ($save_tbl_perencanaan_rencana) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('tbl_perencanaan_rencana', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('tbl_perencanaan_rencana');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('tbl_perencanaan_rencana');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tbl Perencanaan Rencanas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tbl_perencanaan_rencana_delete');

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
            set_message(cclang('has_been_deleted', 'tbl_perencanaan_rencana'), 'success');
        } else {
            set_message(cclang('error_delete', 'tbl_perencanaan_rencana'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tbl Perencanaan Rencanas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tbl_perencanaan_rencana_view');

		$this->data['tbl_perencanaan_rencana'] = $this->model_tbl_perencanaan_rencana->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Rencana Pembangunan Detail');
		$this->render('modul/tbl_perencanaan_rencana/tbl_perencanaan_rencana_view', $this->data);
	}
	
	/**
	* delete Tbl Perencanaan Rencanas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tbl_perencanaan_rencana = $this->model_tbl_perencanaan_rencana->find($id);

		
		
		return $this->model_tbl_perencanaan_rencana->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tbl_perencanaan_rencana_export');

		$this->model_tbl_perencanaan_rencana->export('tbl_perencanaan_rencana', 'tbl_perencanaan_rencana');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tbl_perencanaan_rencana_export');

		$this->model_tbl_perencanaan_rencana->pdf('tbl_perencanaan_rencana', 'tbl_perencanaan_rencana');
	}

	public function form(){
		
		$data = array(); 
		if(isset($_POST['preview'])){ 
			
			$upload = $this->model_tbl_perencanaan_rencana->upload_file($this->filename);
			
			if($upload['result'] == "success"){ 
			
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx');
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				$data['sheet'] = $sheet; 
				
			}else{
				$data['upload_error'] = $upload['error'];
			}
			
		}
		
		//$this->load->view('modul/tbl_perencanaan_rencana/form', $data);
		$this->render('modul/tbl_perencanaan_rencana/form', $data);

	}

	public function import(){
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx');
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){

			if($numrow > 1){
				
				array_push($data, array(
					'pekerjaan'=>$row['C'], 
					'urai_pekerjaan'=>$row['D'],
					'volume'=>$row['L'], 
					'anggaran'=>$row['M'], 
					'kd_wilayah'=>get_user_data('kd_wilayah'), 
				));
			}
			
			$numrow++; 
		}

		$this->model_tbl_perencanaan_rencana->insert_multiple($data);
		
		redirect("Tbl_perencanaan_rencana");
	}
}



/* End of file tbl_perencanaan_rencana.php */
/* Location: ./application/controllers/Tbl Perencanaan Rencana.php */