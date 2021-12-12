<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Penduduk Real Controller
*| --------------------------------------------------------------------------
*| Penduduk Real site
*|
*/
class Penduduk_real extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_penduduk_real');
	}

	/**
	* show all Penduduk Reals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('penduduk_real_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['penduduk_reals'] = $this->model_penduduk_real->get($filter, $field, $this->limit_page, $offset);
		$this->data['penduduk_real_counts'] = $this->model_penduduk_real->count_all($filter, $field);

		$config = [
			'base_url'     => 'penduduk_real/index/',
			'total_rows'   => $this->model_penduduk_real->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Penduduk Real List');
		$this->render('modul/penduduk_real/penduduk_real_list', $this->data);
	}
	
	public function val(){
	    
	    
	    
	    $data_penduduks = db_get_all_data('penduduk_real',"verifikasi='0' AND kd_wilayah LIKE '730305%'");
	    $i='0';
	    foreach($data_penduduks as $data_penduduk){
	        $i++;
	        if($i++ > 800){
	           
	             set_message(cclang('success_save_data_redirect', 'penduduk_real'), 'success');
	             redirect_back();
					 break;
					 
	        }
	   
	    $token = setup_get_token('capil');
	    $data = array(
		"nik" => $data_penduduk->nik,
		"token" => $token,
		"username" => "diskominfosantik",
	);
	 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://silacak.bantaengkab.go.id/api/v1/penduduk');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json')); 
	$result = curl_exec($ch);
	$respon = json_decode($result,true);
	if($respon['0']['response']['kode'] == '200'){
	    $tokens = array(
	        'extoken' => $data['token'],
	        'token' => $respon['0']['new_token']
	        );
	    $this->db->where('site', 'capil');
        $this->db->update('token', $tokens);
        
        $verify = array(
	        'verifikasi' => '1',
	        );
        $this->db->where('nik', $data['nik']);
        $this->db->update('penduduk_real', $verify);
        
        
        $kdwil = $respon['0']['response']['data']['0']['PDDK_Kelurahan_LCK'];
          if($respon['0']['response']['data']['0']['PDDK_Status_KAWIN_LCK'] == 'KAWIN'){$sta_perka ='1';}else if($respon['0']['response']['data']['0']['PDDK_Status_KAWIN_LCK'] == 'BELUM KAWIN'){$sta_perka ='2';}else if($respon['0']['response']['data']['0']['PDDK_Status_KAWIN_LCK'] == 'CERAI HIDUP'){$sta_perka ='3';}else if($respon['0']['response']['data']['0']['PDDK_Status_KAWIN_LCK'] == 'CERAI MATI'){$sta_perka ='4';}
        $kdwilayah = setup_get_wilayah('wilayah',$kdwil);
        
         $datao_penduduk = array(
	        'nik' => $respon['0']['response']['data']['0']['PDDK_Nik_LCK'],
	        'nama' => $respon['0']['response']['data']['0']['PDDK_Nama_LCK'],
	        'jenis_kelamin' => $respon['0']['response']['data']['0']['PDDK_Jenis_Kelamin_LCK'],
	        'tmpt_lahir' => $respon['0']['response']['data']['0']['PDDK_Tempat_Lahir_LCK'],
	        'tgl_lahir' => $respon['0']['response']['data']['0']['PDDK_Tgl_Lahir_LCK'],
	        'alamat' => $respon['0']['response']['data']['0']['PDDK_Alamat_LCK'],
	       // 'agama' => $respon['0']['response']['data']['0']['PDDK_Agama_LCK'],
	       'kd_wilayah' => $kdwilayah,
	        'status_perkawinan' =>$sta_perka,
	        );
	        
	        $this->db->insert('penduduk_dwh', $datao_penduduk);
	}
	
	if($result === false){
	$verify = array(
	        'verifikasi' => '0',
	        );
        $this->db->where('nik', $data['nik']);
        $this->db->update('penduduk_real', $verify);
	}
	
	
	    }
		           set_message(cclang('success_save_data_redirect', 'penduduk_real'), 'success');
	             redirect_back(); 
					
					
	
	}
	
	/**
	* Add new penduduk_reals
	*
	*/
	public function add()
	{
		$this->is_allowed('penduduk_real_add');

		$this->template->title('Penduduk Real New');
		$this->render('modul/penduduk_real/penduduk_real_add', $this->data);
	}

	/**
	* Add New Penduduk Reals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('penduduk_real_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan[]', 'Status Perkawinan', 'trim|required');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'no_kk' => $this->input->post('no_kk'),
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'status_perkawinan' => implode(',', (array) $this->input->post('status_perkawinan')),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'Nama_Ibu' => $this->input->post('Nama_Ibu'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'agama' => $this->input->post('agama'),
				'gologan_dara' => $this->input->post('gologan_dara'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'golongan_dara' => $this->input->post('golongan_dara'),
			];

			
			$save_penduduk_real = $this->model_penduduk_real->store($save_data);

			if ($save_penduduk_real) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_penduduk_real;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('penduduk_real/edit/' . $save_penduduk_real, 'Edit Penduduk Real'),
						anchor('penduduk_real', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('penduduk_real/edit/' . $save_penduduk_real, 'Edit Penduduk Real')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk_real');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk_real');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Penduduk Reals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('penduduk_real_update');

		$this->data['penduduk_real'] = $this->model_penduduk_real->find($id);

		$this->template->title('Penduduk Real Update');
		$this->render('modul/penduduk_real/penduduk_real_update', $this->data);
	}

	/**
	* Update Penduduk Reals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('penduduk_real_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
// 		$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('no_kk', 'No Kk', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('status_hubungan', 'Status Hubungan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('status_perkawinan[]', 'Status Perkawinan', 'trim|required');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				// 'kd_wilayah' => $this->input->post('kd_wilayah'),
				'nik' => $this->input->post('nik'),
				'no_kk' => $this->input->post('no_kk'),
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'status_hubungan' => $this->input->post('status_hubungan'),
				'status_perkawinan' => implode(',', (array) $this->input->post('status_perkawinan')),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'Nama_Ibu' => $this->input->post('Nama_Ibu'),
				'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
				'agama' => $this->input->post('agama'),
				'gologan_dara' => $this->input->post('gologan_dara'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'golongan_dara' => $this->input->post('golongan_dara'),
			];

			
			$save_penduduk_real = $this->model_penduduk_real->change($id, $save_data);

			if ($save_penduduk_real) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('penduduk_real', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('penduduk_real');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('penduduk_real');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Penduduk Reals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('penduduk_real_delete');

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
            set_message(cclang('has_been_deleted', 'penduduk_real'), 'success');
        } else {
            set_message(cclang('error_delete', 'penduduk_real'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Penduduk Reals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('penduduk_real_view');

		$this->data['penduduk_real'] = $this->model_penduduk_real->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Penduduk Real Detail');
		$this->render('modul/penduduk_real/penduduk_real_view', $this->data);
	}
	
	/**
	* delete Penduduk Reals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$penduduk_real = $this->model_penduduk_real->find($id);

		
		
		return $this->model_penduduk_real->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('penduduk_real_export');

		$this->model_penduduk_real->export('penduduk_real', 'penduduk_real');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('penduduk_real_export');

		$this->model_penduduk_real->pdf('penduduk_real', 'penduduk_real');
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
				 

				 $a = db_get_all_data('penduduk_real',"nik=$nik ");

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
                    "golongan_dara"=> $rowData[0][10],
                    "pendidikan_terakhir"=> $rowData[0][11],
                    "jenis_pekerjaan"=> $rowData[0][12],
                    "bidang_pekerjaan"=> $rowData[0][13]
					);
					$insert = $this->db->insert("penduduk_real",$data);
					
				
 							} 
			
                      
			}
			unlink($inputFileName);
			set_message("Berhasil Di Import","success");
			redirect('penduduk_real/import');

        }
}


/* End of file penduduk_real.php */
/* Location: ./application/controllers/Penduduk Real.php */