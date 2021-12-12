<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dtks Controller
*| --------------------------------------------------------------------------
*| Dtks site
*|
*/
class Dtks extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dtks');
		$this->load->library('Excel');

	}


	public function bantuan($offset = 0)
	{
		$this->is_allowed('tbl_bantuan_list');
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dtkss'] = $this->model_dtks->get_bantuan($filter, $field, $this->limit_page, $offset);
		$this->data['dtks_counts'] = $this->model_dtks->count_all_bantuan($filter, $field);

		$config = [
			'base_url'     => 'dtks/bantuan/',
			'total_rows'   => $this->model_dtks->count_all_bantuan($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Bantuan');
		$this->render('modul/dtks/dtks_list_bantuan',$this->data);
	}



	public function disabilitas($offset = 0)
	{
		$this->is_allowed('tbl_disabilitas_list');
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dtkss'] = $this->model_dtks->get_list($filter, $field, $this->limit_page, $offset);
		$this->data['dtks_counts'] = $this->model_dtks->count_all_list($filter, $field);

		$config = [
			'base_url'     => 'dtks/disabilitas/',
			'total_rows'   => $this->model_dtks->count_all_list($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Disabilitas dan Rentan');
		$this->render('modul/dtks/dtks_list_disabilitas',$this->data);
	}

	/**
	* show all Dtkss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dtks_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dtkss'] = $this->model_dtks->get($filter, $field, $this->limit_page, $offset);
		$this->data['dtks_counts'] = $this->model_dtks->count_all($filter, $field);

		$config = [
			'base_url'     => 'dtks/index/',
			'total_rows'   => $this->model_dtks->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data DTKS List');
		$this->render('modul/dtks/dtks_list', $this->data);
	}
	
	
		/**
	* Update view Dtkss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dtks_update');

		$this->data['dtks'] = $this->model_dtks->find($id);

		$this->template->title('Data DTKS Update');
		$this->render('modul/dtks/dtks_update', $this->data);
	}

	/**
	* Update Dtkss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dtks_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('alamat', 'Alamat Tempat Tinggal', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('jumlah_keluarga', 'Jumlah Anggota Keluarga', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('no_kk', 'No. KK', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan Keluarga', 'trim|required');
		$this->form_validation->set_rules('status_kesejahteraan', 'Status Kesejahteraan (DESIL)', 'trim|required');
		$this->form_validation->set_rules('status_kepemilikan_bangunan', 'Status Kepemilikan Bangunan', 'trim|required');
		$this->form_validation->set_rules('status_kepemilikan_tanah', 'Status Kepemilikan Tanah', 'trim|required');
		$this->form_validation->set_rules('kks_kps', 'KKS/KPS', 'trim|required');
		$this->form_validation->set_rules('pkh', 'PKH', 'trim|required');
		$this->form_validation->set_rules('raskin', 'RASKIN', 'trim|required');
		$this->form_validation->set_rules('kur', 'KUR', 'trim|required');
		$this->form_validation->set_rules('jenis_cacat', 'Jenis Cacat', 'trim|required');
		$this->form_validation->set_rules('penyakit_kronis', 'Penyakit Kronis', 'trim|required');
		$this->form_validation->set_rules('status_kehamilan', 'Status Kehmilan', 'trim|required');
		$this->form_validation->set_rules('kip_bsm', 'KIP/BSM', 'trim|required');
		$this->form_validation->set_rules('kis_bpjs', 'KIS/BPJS KESEHATAN/JAMKESMAS', 'trim|required');
		$this->form_validation->set_rules('bpjs_mandiri', 'BPJS KESEHATAN PESERTA MANDIRI', 'trim|required');
		$this->form_validation->set_rules('jamsostek', 'JAMSOSTEK/BPJS KETENAGAKERJAAN', 'trim|required');
		$this->form_validation->set_rules('asuransi_lainnya', 'ASURANSI KESEHATAN LAINNYA', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'alamat' => $this->input->post('alamat'),
				'jumlah_keluarga' => $this->input->post('jumlah_keluarga'),
				'no_kk' => $this->input->post('no_kk'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'status_kesejahteraan' => $this->input->post('status_kesejahteraan'),
				'status_kepemilikan_bangunan' => $this->input->post('status_kepemilikan_bangunan'),
				'status_kepemilikan_tanah' => $this->input->post('status_kepemilikan_tanah'),
				'kks_kps' => $this->input->post('kks_kps'),
				'pkh' => $this->input->post('pkh'),
				'raskin' => $this->input->post('raskin'),
				'kur' => $this->input->post('kur'),
				'jenis_cacat' => $this->input->post('jenis_cacat'),
				'penyakit_kronis' => $this->input->post('penyakit_kronis'),
				'status_kehamilan' => $this->input->post('status_kehamilan'),
				'kip_bsm' => $this->input->post('kip_bsm'),
				'kis_bpjs' => $this->input->post('kis_bpjs'),
				'bpjs_mandiri' => $this->input->post('bpjs_mandiri'),
				'jamsostek' => $this->input->post('jamsostek'),
				'asuransi_lainnya' => $this->input->post('asuransi_lainnya'),
				'status' => $this->input->post('status'),
				'last_updated_by' => get_user_data('username'),
				'last_updated_date' => date('Y-m-d H:i:s'),
			];

			
			$save_dtks = $this->model_dtks->change($id, $save_data);

			if ($save_dtks) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('dtks', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('dtks');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('dtks');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dtkss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dtks_delete');

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
            set_message(cclang('has_been_deleted', 'dtks'), 'success');
        } else {
            set_message(cclang('error_delete', 'dtks'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dtkss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dtks_view');

		$this->data['dtks'] = $this->model_dtks->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Data DTKS Detail');
		$this->render('modul/dtks/dtks_view', $this->data);
	}
	
	/**
	* delete Dtkss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dtks = $this->model_dtks->find($id);

		
		
		return $this->model_dtks->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dtks_export');

		$this->model_dtks->export('dtks', 'dtks');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dtks_export');

		$this->model_dtks->pdf('dtks', 'dtks');
	}



	public function import()
	{
		$this->is_allowed('dtks_import');


		$this->template->title('Data DTKS Import');
		$this->render('modul/dtks/dtks_import');
	}


	public function upload()
	{
		$this->is_allowed('dtks_import');

		$fileName = $_FILES['file']['name'];
          
        $config['upload_path'] = './asset/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze
 
        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);
          
        if(! $this->upload->do_upload('file') ){
            echo $this->upload->display_errors();exit();
        }
              
        $inputFileName = './asset/'.$fileName;
 
        try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
			
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
												FALSE);  
												$var  = PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][7],  'YYYY-MM-DD');
 
				 // Sesuaikan key array dengan nama kolom di database 
				 $nik = $rowData[0][4];
				 $no_kk = $rowData[0][3];
				 $a = db_get_all_data('penduduk',"nik= $nik AND no_kk= $no_kk");
				 if (COUNT($a) >= '1') {
				 	$status ="Terverifikasi";
				 } else {
				 	$status ="Belum Terverifikasi";
				 }
				 

				 // $a = db_get_all_data_date_range('vw_permohonan',"nip_pegawai=$nip ", date('Y-m-d',strtotime($var)),date('Y-m-d',strtotime($var)));

				                                                   
                 	$data = array(
                    "tgl_lahir"=> date('Y-m-d',strtotime($var)),
                    "kd_wilayah"=> $rowData[0][0],
                    "alamat"=> $rowData[0][1],
                    "jumlah_keluarga"=> $rowData[0][2],
                    "no_kk"=> $rowData[0][3],
                    "nik"=> $rowData[0][4],
                    "nama"=> $rowData[0][5],
                    "jenis_kelamin"=> $rowData[0][6],
                    "status_perkawinan"=> $rowData[0][8],
                    "status_hubungan"=> $rowData[0][9],
                    "status_kesejahteraan"=> $rowData[0][10],
                    "status_kepemilikan_bangunan"=> $rowData[0][11],
                    "status_kepemilikan_tanah"=> $rowData[0][12],
                    "kks_kps"=> $rowData[0][13],
                    "pkh"=> $rowData[0][14],
                    "raskin"=> $rowData[0][15],
                    "kur"=> $rowData[0][16],
                    "jenis_cacat"=> $rowData[0][17],
                    "penyakit_kronis"=> $rowData[0][18],
                    "status_kehamilan"=> $rowData[0][19],
                    "kip_bsm"=> $rowData[0][20],
                    "kis_bpjs"=> $rowData[0][21],
                    "bpjs_mandiri"=> $rowData[0][22],
                    "jamsostek"=> $rowData[0][23],
                    "asuransi_lainnya"=> $rowData[0][24],
                    "status"=> $status
					);
					$insert = $this->db->insert("dtks",$data);
					
				
 
			
                      
			}
			unlink($inputFileName);
			redirect('dtks/import');
			set_message("Berhasi Di Upload");  

        }
}


/* End of file dtks.php */
/* Location: ./application/controllers/Dtks.php */