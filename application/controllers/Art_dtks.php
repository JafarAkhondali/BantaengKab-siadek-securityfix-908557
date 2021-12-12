<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Art Dtks Controller
*| --------------------------------------------------------------------------
*| Art Dtks site
*|
*/
class Art_dtks extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_art_dtks');
		$this->load->library('excel');

	}
	
	public function template(){
	    force_download('uploads/art_dtks.xlsx',NULL);
	}

	/**
	* show all Art Dtkss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('art_dtks_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['art_dtkss'] = $this->model_art_dtks->get($filter, $field, $this->limit_page, $offset);
		$this->data['art_dtks_counts'] = $this->model_art_dtks->count_all($filter, $field);

		$config = [
			'base_url'     => 'art_dtks/index/',
			'total_rows'   => $this->model_art_dtks->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Art Dtks List');
		$this->render('modul/art_dtks/art_dtks_list', $this->data);
	}
	
	
	

	
	
	
	/**
	* Add new art_dtkss
	*
	*/
	public function add()
	{
		$this->is_allowed('art_dtks_add');

		$this->template->title('Art Dtks New');
		$this->render('modul/art_dtks/art_dtks_add', $this->data);
	}

	/**
	* Add New Art Dtkss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('art_dtks_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		//$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('IDBDT', 'IDBDT', 'trim|required');
		$this->form_validation->set_rules('IDARTBDT', 'IDARTBDT', 'trim|required');
		$this->form_validation->set_rules('KDPROP', 'KDPROP', 'trim|required');
		$this->form_validation->set_rules('KDKAB', 'KDKAB', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('KDKEC', 'KDKEC', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Nama', 'Nama', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('JnsKel[]', 'JnsKel', 'trim|required');
		$this->form_validation->set_rules('TmpLahir', 'TmpLahir', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('TglLahir', 'TglLahir', 'trim|required');
		$this->form_validation->set_rules('HubKRT', 'HubKRT', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NIK', 'NIK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NoKK', 'NoKK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Hub_KRT', 'Hub KRT', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NUK', 'NUK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Hubkel', 'Hubkel', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Umur', 'Umur', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Sta_kawin', 'Sta Kawin', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_akta_nikah', 'Ada Akta Nikah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_diKK', 'Ada DiKK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_kartu_identitas', 'Ada Kartu Identitas', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Sta_hamil', 'Sta Hamil', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Jenis_cacat', 'Jenis Cacat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Penyakit_kronis', 'Penyakit Kronis', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Partisipasi_sekolah', 'Partisipasi Sekolah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Pendidikan_tertinggi', 'Pendidikan Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Kelas_tertinggi', 'Kelas Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Ijazah_tertinggi', 'Ijazah Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Sta_Bekerja', 'Sta Bekerja', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				//'kd_wilayah' => get_user_data('kd_wilayah'),
				'IDBDT' => $this->input->post('IDBDT'),
				'IDARTBDT' => $this->input->post('IDARTBDT'),
				'KDPROP' => $this->input->post('KDPROP'),
				'KDKAB' => $this->input->post('KDKAB'),
				'KDKEC' => $this->input->post('KDKEC'),
				'KDDESA' => $this->input->post('KDDESA'),
				'NoPesertaPKH' => $this->input->post('NoPesertaPKH'),
				'Nama' => $this->input->post('Nama'),
				'JnsKel' => implode(',', (array) $this->input->post('JnsKel')),
				'TmpLahir' => $this->input->post('TmpLahir'),
				'TglLahir' => $this->input->post('TglLahir'),
				'HubKRT' => $this->input->post('HubKRT'),
				'NIK' => $this->input->post('NIK'),
				'NoKK' => $this->input->post('NoKK'),
				'Hub_KRT' => $this->input->post('Hub_KRT'),
				'NUK' => $this->input->post('NUK'),
				'Hubkel' => $this->input->post('Hubkel'),
				'Umur' => $this->input->post('Umur'),
				'Sta_kawin' => $this->input->post('Sta_kawin'),
				'Ada_akta_nikah' => $this->input->post('Ada_akta_nikah'),
				'Ada_diKK' => $this->input->post('Ada_diKK'),
				'Ada_kartu_identitas' => $this->input->post('Ada_kartu_identitas'),
				'Sta_hamil' => $this->input->post('Sta_hamil'),
				'Jenis_cacat' => $this->input->post('Jenis_cacat'),
				'Penyakit_kronis' => $this->input->post('Penyakit_kronis'),
				'Partisipasi_sekolah' => $this->input->post('Partisipasi_sekolah'),
				'Pendidikan_tertinggi' => $this->input->post('Pendidikan_tertinggi'),
				'Kelas_tertinggi' => $this->input->post('Kelas_tertinggi'),
				'Ijazah_tertinggi' => $this->input->post('Ijazah_tertinggi'),
				'Sta_Bekerja' => $this->input->post('Sta_Bekerja'),
				'Jumlah_jamkerja' => $this->input->post('Jumlah_jamkerja'),
				'Lapangan_usaha' => $this->input->post('Lapangan_usaha'),
				'Status_pekerjaan' => $this->input->post('Status_pekerjaan'),
				'Sta_keberadaan_art' => $this->input->post('Sta_keberadaan_art'),
				'Sta_kepesertaan_pbi' => $this->input->post('Sta_kepesertaan_pbi'),
				'Ada_kks' => $this->input->post('Ada_kks'),
				'Ada_pbi' => $this->input->post('Ada_pbi'),
				'Ada_kip' => $this->input->post('Ada_kip'),
				'Ada_pkh' => $this->input->post('Ada_pkh'),
				'Ada_BPNT' => $this->input->post('Ada_BPNT'),
				'Anak_diluar_rt' => $this->input->post('Anak_diluar_rt'),
				'namagadis_ibukandung' => $this->input->post('namagadis_ibukandung'),
			];

			
			$save_art_dtks = $this->model_art_dtks->store($save_data);

			if ($save_art_dtks) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_art_dtks;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('art_dtks/edit/' . $save_art_dtks, 'Edit Art Dtks'),
						anchor('art_dtks', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('art_dtks/edit/' . $save_art_dtks, 'Edit Art Dtks')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('art_dtks');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('art_dtks');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Art Dtkss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('art_dtks_update');

		$this->data['art_dtks'] = $this->model_art_dtks->find($id);

		$this->template->title('Art Dtks Update');
		$this->render('modul/art_dtks/art_dtks_update', $this->data);
	}

	/**
	* Update Art Dtkss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('art_dtks_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
	//	$this->form_validation->set_rules('kd_wilayah', 'Kd Wilayah', 'trim|required');
		$this->form_validation->set_rules('IDBDT', 'IDBDT', 'trim|required');
		$this->form_validation->set_rules('IDARTBDT', 'IDARTBDT', 'trim|required');
		$this->form_validation->set_rules('KDPROP', 'KDPROP', 'trim|required');
		$this->form_validation->set_rules('KDKAB', 'KDKAB', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('KDKEC', 'KDKEC', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Nama', 'Nama', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('JnsKel[]', 'JnsKel', 'trim|required');
		$this->form_validation->set_rules('TmpLahir', 'TmpLahir', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('TglLahir', 'TglLahir', 'trim|required');
		$this->form_validation->set_rules('HubKRT', 'HubKRT', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NIK', 'NIK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NoKK', 'NoKK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Hub_KRT', 'Hub KRT', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NUK', 'NUK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Hubkel', 'Hubkel', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Umur', 'Umur', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Sta_kawin', 'Sta Kawin', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_akta_nikah', 'Ada Akta Nikah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_diKK', 'Ada DiKK', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Ada_kartu_identitas', 'Ada Kartu Identitas', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Sta_hamil', 'Sta Hamil', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Jenis_cacat', 'Jenis Cacat', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Penyakit_kronis', 'Penyakit Kronis', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Partisipasi_sekolah', 'Partisipasi Sekolah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Pendidikan_tertinggi', 'Pendidikan Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Kelas_tertinggi', 'Kelas Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Ijazah_tertinggi', 'Ijazah Tertinggi', 'trim|required');
		$this->form_validation->set_rules('Sta_Bekerja', 'Sta Bekerja', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				//'kd_wilayah' => get_user_data('kd_wilayah'),
				'IDBDT' => $this->input->post('IDBDT'),
				'IDARTBDT' => $this->input->post('IDARTBDT'),
				'KDPROP' => $this->input->post('KDPROP'),
				'KDKAB' => $this->input->post('KDKAB'),
				'KDKEC' => $this->input->post('KDKEC'),
				'KDDESA' => $this->input->post('KDDESA'),
				'NoPesertaPKH' => $this->input->post('NoPesertaPKH'),
				'Nama' => $this->input->post('Nama'),
				'JnsKel' => implode(',', (array) $this->input->post('JnsKel')),
				'TmpLahir' => $this->input->post('TmpLahir'),
				'TglLahir' => $this->input->post('TglLahir'),
				'HubKRT' => $this->input->post('HubKRT'),
				'NIK' => $this->input->post('NIK'),
				'NoKK' => $this->input->post('NoKK'),
				'Hub_KRT' => $this->input->post('Hub_KRT'),
				'NUK' => $this->input->post('NUK'),
				'Hubkel' => $this->input->post('Hubkel'),
				'Umur' => $this->input->post('Umur'),
				'Sta_kawin' => $this->input->post('Sta_kawin'),
				'Ada_akta_nikah' => $this->input->post('Ada_akta_nikah'),
				'Ada_diKK' => $this->input->post('Ada_diKK'),
				'Ada_kartu_identitas' => $this->input->post('Ada_kartu_identitas'),
				'Sta_hamil' => $this->input->post('Sta_hamil'),
				'Jenis_cacat' => $this->input->post('Jenis_cacat'),
				'Penyakit_kronis' => $this->input->post('Penyakit_kronis'),
				'Partisipasi_sekolah' => $this->input->post('Partisipasi_sekolah'),
				'Pendidikan_tertinggi' => $this->input->post('Pendidikan_tertinggi'),
				'Kelas_tertinggi' => $this->input->post('Kelas_tertinggi'),
				'Ijazah_tertinggi' => $this->input->post('Ijazah_tertinggi'),
				'Sta_Bekerja' => $this->input->post('Sta_Bekerja'),
				'Jumlah_jamkerja' => $this->input->post('Jumlah_jamkerja'),
				'Lapangan_usaha' => $this->input->post('Lapangan_usaha'),
				'Status_pekerjaan' => $this->input->post('Status_pekerjaan'),
				'Sta_keberadaan_art' => $this->input->post('Sta_keberadaan_art'),
				'Sta_kepesertaan_pbi' => $this->input->post('Sta_kepesertaan_pbi'),
				'Ada_kks' => $this->input->post('Ada_kks'),
				'Ada_pbi' => $this->input->post('Ada_pbi'),
				'Ada_kip' => $this->input->post('Ada_kip'),
				'Ada_pkh' => $this->input->post('Ada_pkh'),
				'Ada_BPNT' => $this->input->post('Ada_BPNT'),
				'Anak_diluar_rt' => $this->input->post('Anak_diluar_rt'),
				'namagadis_ibukandung' => $this->input->post('namagadis_ibukandung'),
			];

			
			$save_art_dtks = $this->model_art_dtks->change($id, $save_data);

			if ($save_art_dtks) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('art_dtks', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('art_dtks');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('art_dtks');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Art Dtkss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('art_dtks_delete');

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
            set_message(cclang('has_been_deleted', 'art_dtks'), 'success');
        } else {
            set_message(cclang('error_delete', 'art_dtks'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Art Dtkss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('art_dtks_view');

		$this->data['art_dtks'] = $this->model_art_dtks->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Art Dtks Detail');
		$this->render('modul/art_dtks/art_dtks_view', $this->data);
	}
	
	/**
	* delete Art Dtkss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$art_dtks = $this->model_art_dtks->find($id);

		
		
		return $this->model_art_dtks->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('art_dtks_export');

		$this->model_art_dtks->export('art_dtks', 'art_dtks');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('art_dtks_export');

		$this->model_art_dtks->pdf('art_dtks', 'art_dtks');
	}

		public function import()
	{
		$this->is_allowed('dtks_real_import');


		$this->template->title('Data art dtks Import');
		$this->render('modul/art_dtks/art_dtks_import');
	}

	public function upload()
	{
		$this->is_allowed('art_dtks_import');

		$fileName = $_FILES['file']['name'];
          
        $config['upload_path'] = './uploads/art_dtks/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; 
        // maksimal sizze
 
        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);
          
        if(! $this->upload->do_upload('file') ){
            echo $this->upload->display_errors();exit();
        }
              
        $inputFileName = './uploads/art_dtks/'.$fileName;
 
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
												$var  = PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][8],  'YYYY-MM-DD');
 
				 // Sesuaikan key array dengan nama kolom di database 
				 $IDARTBDT = $rowData[0][1];
				 $NIK = $rowData[0][10];
				 $kddesa = $rowData[0][5];
				 
				 
                 $b = db_get_all_data('penduduk_dwh',"nik=$NIK");
				 $a = db_get_all_data('art_dtks',"IDARTBDT=$IDARTBDT");

				        if (count($a) < '1') {
				                                                                                             
                 	$data = array(
                    "IDBDT"=> $rowData[0][0],
                    "IDARTBDT"=> $rowData[0][1],
                    "KDPROP"=> $rowData[0][2],
                    "KDKAB"=> $rowData[0][3],
                    "KDKEC"=> $rowData[0][4],
                    "KDDESA"=> $rowData[0][5],
                    "JnsKel"=> $rowData[0][6],
                    "TmpLahir"=> $rowData[0][7],
                    "TglLahir"=> date('Y-m-d',strtotime($var)),
                    "HubKRT"=> $rowData[0][9],
                    "NIK"=> $rowData[0][10],
                    "NoKK"=> $rowData[0][11],
                    "Hub_KRT"=> $rowData[0][12],
                    "NUK"=> $rowData[0][13],
                    "Hubkel"=> $rowData[0][14],
                    "Umur"=> $rowData[0][15],
                    "Sta_kawin"=> $rowData[0][16],
                    "Ada_akta_nikah"=> $rowData[0][17],
                    "Ada_diKK"=> $rowData[0][18],
                    "Ada_kartu_identitas"=> $rowData[0][19],
                    "Sta_hamil"=> $rowData[0][20],
                    "Jenis_cacat"=> $rowData[0][21],
                    "Penyakit_kronis"=> $rowData[0][22],
                    "Partisipasi_sekolah"=> $rowData[0][23],
                    "Pendidikan_tertinggi"=> $rowData[0][24],
                    "Kelas_tertinggi"=> $rowData[0][25],
                    "Ijazah_tertinggi"=> $rowData[0][26],
                    "Sta_Bekerja"=> $rowData[0][27],
                    "Jumlah_jamkerja"=> $rowData[0][28],
                    "Lapangan_usaha"=> $rowData[0][29],
                    "Status_pekerjaan"=> $rowData[0][30],
                    "Sta_keberadaan_art"=> $rowData[0][31],
                    "Sta_kepesertaan_pbi"=> $rowData[0][32],
                    "Ada_kks"=> $rowData[0][33],
                    "Ada_pbi"=> $rowData[0][34],
                    "Ada_kip"=> $rowData[0][35],
                    "Ada_pkh"=> $rowData[0][36],
                    "Ada_BPNT"=> $rowData[0][37],
                    "Anak_diluar_rt"=> $rowData[0][38],
                    "namagadis_ibukandung"=> $rowData[0][39],
                    "periode" => date('Y'),
					);
					$insert = $this->db->insert("art_dtks",$data);
					
					
					if(count($b) > '1'){
					    $wil = '';
					    foreach($b as $bs){
					    $wil = $bs->kd_wilayah;
					    }
					    if($wil == $rowData[0][5] ){
					        $status = '4';
					    }else{
					        $status = '1';
					    }
					    $data_pemadanan = array(
                    "IDBDT"=> $rowData[0][0],
                    "IDARTBDT"=> $rowData[0][1],
                    "KDPROP"=> $rowData[0][2],
                    "KDKAB"=> $rowData[0][3],
                    "KDKEC"=> $rowData[0][4],
                    "KDDESA"=> $rowData[0][5],
                    "JnsKel"=> $rowData[0][6],
                    "TmpLahir"=> $rowData[0][7],
                    "TglLahir"=> date('Y-m-d',strtotime($var)),
                    "HubKRT"=> $rowData[0][9],
                    "NIK"=> $rowData[0][10],
                    "NoKK"=> $rowData[0][11],
                    "Hub_KRT"=> $rowData[0][12],
                    "NUK"=> $rowData[0][13],
                    "Hubkel"=> $rowData[0][14],
                    "Umur"=> $rowData[0][15],
                    "Sta_kawin"=> $rowData[0][16],
                    "Ada_akta_nikah"=> $rowData[0][17],
                    "Ada_diKK"=> $rowData[0][18],
                    "Ada_kartu_identitas"=> $rowData[0][19],
                    "Sta_hamil"=> $rowData[0][20],
                    "Jenis_cacat"=> $rowData[0][21],
                    "Penyakit_kronis"=> $rowData[0][22],
                    "Partisipasi_sekolah"=> $rowData[0][23],
                    "Pendidikan_tertinggi"=> $rowData[0][24],
                    "Kelas_tertinggi"=> $rowData[0][25],
                    "Ijazah_tertinggi"=> $rowData[0][26],
                    "Sta_Bekerja"=> $rowData[0][27],
                    "Jumlah_jamkerja"=> $rowData[0][28],
                    "Lapangan_usaha"=> $rowData[0][29],
                    "Status_pekerjaan"=> $rowData[0][30],
                    "Sta_keberadaan_art"=> $rowData[0][31],
                    "Sta_kepesertaan_pbi"=> $rowData[0][32],
                    "Ada_kks"=> $rowData[0][33],
                    "Ada_pbi"=> $rowData[0][34],
                    "Ada_kip"=> $rowData[0][35],
                    "Ada_pkh"=> $rowData[0][36],
                    "Ada_BPNT"=> $rowData[0][37],
                    "Anak_diluar_rt"=> $rowData[0][38],
                    "namagadis_ibukandung"=> $rowData[0][39],
                    "Status" => $status,
                    "periode" => date('Y'),
					);
					$insert = $this->db->insert("art_dtks_pemadanan",$data_pemadanan);
					}else{
					    $data_pemadanan = array(
                    "IDBDT"=> $rowData[0][0],
                    "IDARTBDT"=> $rowData[0][1],
                    "KDPROP"=> $rowData[0][2],
                    "KDKAB"=> $rowData[0][3],
                    "KDKEC"=> $rowData[0][4],
                    "KDDESA"=> $rowData[0][5],
                    "JnsKel"=> $rowData[0][6],
                    "TmpLahir"=> $rowData[0][7],
                    "TglLahir"=> date('Y-m-d',strtotime($var)),
                    "HubKRT"=> $rowData[0][9],
                    "NIK"=> $rowData[0][10],
                    "NoKK"=> $rowData[0][11],
                    "Hub_KRT"=> $rowData[0][12],
                    "NUK"=> $rowData[0][13],
                    "Hubkel"=> $rowData[0][14],
                    "Umur"=> $rowData[0][15],
                    "Sta_kawin"=> $rowData[0][16],
                    "Ada_akta_nikah"=> $rowData[0][17],
                    "Ada_diKK"=> $rowData[0][18],
                    "Ada_kartu_identitas"=> $rowData[0][19],
                    "Sta_hamil"=> $rowData[0][20],
                    "Jenis_cacat"=> $rowData[0][21],
                    "Penyakit_kronis"=> $rowData[0][22],
                    "Partisipasi_sekolah"=> $rowData[0][23],
                    "Pendidikan_tertinggi"=> $rowData[0][24],
                    "Kelas_tertinggi"=> $rowData[0][25],
                    "Ijazah_tertinggi"=> $rowData[0][26],
                    "Sta_Bekerja"=> $rowData[0][27],
                    "Jumlah_jamkerja"=> $rowData[0][28],
                    "Lapangan_usaha"=> $rowData[0][29],
                    "Status_pekerjaan"=> $rowData[0][30],
                    "Sta_keberadaan_art"=> $rowData[0][31],
                    "Sta_kepesertaan_pbi"=> $rowData[0][32],
                    "Ada_kks"=> $rowData[0][33],
                    "Ada_pbi"=> $rowData[0][34],
                    "Ada_kip"=> $rowData[0][35],
                    "Ada_pkh"=> $rowData[0][36],
                    "Ada_BPNT"=> $rowData[0][37],
                    "Anak_diluar_rt"=> $rowData[0][38],
                    "namagadis_ibukandung"=> $rowData[0][39],
                    "Status" => '2',
                    "periode" => date('Y'),
					);
					$insert = $this->db->insert("art_dtks_pemadanan",$data_pemadanan);
					}

					
				
 			} 
                      
			}
			unlink($inputFileName);
			set_message("Berhasil Di Import","success");
			redirect('art_dtks/import');
			
        }
}


/* End of file art_dtks.php */
/* Location: ./application/controllers/Art Dtks.php */