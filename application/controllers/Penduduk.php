<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Penduduk Controller
*| --------------------------------------------------------------------------
*| Penduduk site
*|
*/
class Penduduk extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_penduduk');
		$this->load->library('excel');
	}

	/**
	* show all Penduduks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('penduduk_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['penduduks'] = $this->model_penduduk->get($filter, $field, $this->limit_page, $offset);
		$this->data['penduduk_counts'] = $this->model_penduduk->count_all($filter, $field);

		$config = [
			'base_url'     => 'penduduk/index/',
			'total_rows'   => $this->model_penduduk->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);
    
		$this->template->title('Penduduk List');
		$this->render('modul/penduduk/penduduk_list', $this->data);
	}
	
	/**
	* Add new penduduks
	*
	*/
	public function add()
	{
		$this->is_allowed('penduduk_add');
		$this->template->title('Penduduk New');
		$this->data['token'] = sha1("siadekv2","kompakbantaeng");
		$this->render('modul/penduduk/penduduk_add', $this->data);
	}

	/**
	* Add New Penduduks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('penduduk_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]|is_unique[penduduk.nik]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('kepemilikan_akte_perkawinan', 'Kepemilikan Akte Perkawinan', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('bidang_pekerjaan', 'Bidang Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_message('is_unique', 'NIK Telah Terdaftar');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'agama' => $this->input->post('agama'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'kepemilikan_akte_perkawinan' => $this->input->post('kepemilikan_akte_perkawinan'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'bidang_pekerjaan' => $this->input->post('bidang_pekerjaan'),
				'no_kk' => $this->input->post('no_kk'),
				'kd_wilayah' => implode(',', (array) $this->input->post('kd_wilayah')),
			];

			
			$save_penduduk = $this->model_penduduk->store($save_data);

			if ($save_penduduk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_penduduk;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('penduduk/edit/' . $save_penduduk, 'Edit Penduduk'),
						anchor('penduduk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('penduduk/edit/' . $save_penduduk, 'Edit Penduduk')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Penduduks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('penduduk_update');

		$this->data['penduduk'] = $this->model_penduduk->find($id);

		$this->template->title('Penduduk Update');
		$this->render('modul/penduduk/penduduk_update', $this->data);
	}

	/**
	* Update Penduduks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('penduduk_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]|is_unique[pendudul.nik]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('agama', 'Agama', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('kepemilikan_akte_perkawinan', 'Kepemilikan Akte Perkawinan', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jenis_pekerjaan', 'Jenis Pekerjaan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('bidang_pekerjaan', 'Bidang Pekerjaan', 'trim|required');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_message('is_unique', 'NIK Telah Terdaftar');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'agama' => $this->input->post('agama'),
				'status_perkawinan' => $this->input->post('status_perkawinan'),
				'kepemilikan_akte_perkawinan' => $this->input->post('kepemilikan_akte_perkawinan'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'bidang_pekerjaan' => $this->input->post('bidang_pekerjaan'),
				'no_kk' => $this->input->post('no_kk'),
				'kd_wilayah' => implode(',', (array) $this->input->post('kd_wilayah')),
			];

			
			$save_penduduk = $this->model_penduduk->change($id, $save_data);

			if ($save_penduduk) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('penduduk', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Penduduks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('penduduk_delete');

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
            set_message(cclang('has_been_deleted', 'penduduk'), 'success');
        } else {
            set_message(cclang('error_delete', 'penduduk'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Penduduks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('penduduk_view');

		$this->data['penduduk'] = $this->model_penduduk->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Penduduk Detail');
		$this->render('modul/penduduk/penduduk_view', $this->data);
	}
	
	/**
	* delete Penduduks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$penduduk = $this->model_penduduk->find($id);

		
		
		return $this->model_penduduk->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('penduduk_export');

		$this->model_penduduk->export('penduduk', 'penduduk');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('penduduk_export');

		$this->model_penduduk->pdf('penduduk', 'penduduk');
	}


	public function import()
	{
		$this->is_allowed('penduduk_import');


		$this->template->title('Data Penduduk Import');
		$this->render('modul/penduduk/penduduk_import');
	}

	public function upload()
	{
		$this->is_allowed('penduduk_import');

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
												$var  = PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][4],  'YYYY-MM-DD');
 
				 // Sesuaikan key array dengan nama kolom di database 
				 $nik = $rowData[0][1];
				 $no_kk = $rowData[0][14];
				 

				 $a = db_get_all_data('penduduk',"nik=$nik ");

				        if (count($a) < '1') {
				                                                                                             
                 	$data = array(
                    "tgl_lahir"=> date('Y-m-d',strtotime($var)),
                    "kd_wilayah"=> $rowData[0][0],
                    "alamat"=> $rowData[0][6],
                    "agama"=> $rowData[0][8],
                    "no_kk"=> $rowData[0][14],
                    "nik"=> $rowData[0][1],
                    "nama"=> $rowData[0][2],
                    "tempat_lahir"=> $rowData[0][3],
                    "jenis_kelamin"=> $rowData[0][5],
                    "status_perkawinan"=> $rowData[0][9],
                    "status_hubungan"=> $rowData[0][7],
                    "kepemilikan_akte_perkawinan"=> $rowData[0][10],
                    "pendidikan_terakhir"=> $rowData[0][11],
                    "jenis_pekerjaan"=> $rowData[0][12],
                    "bidang_pekerjaan"=> $rowData[0][13]
					);
					$insert = $this->db->insert("penduduk",$data);
					
				
 							} 
			
                      
			}
			unlink($inputFileName);
			set_message("Berhasil Di Import","success");
			redirect('penduduk/import');

        }
}


/* End of file penduduk.php */
/* Location: ./application/controllers/Penduduk.php */