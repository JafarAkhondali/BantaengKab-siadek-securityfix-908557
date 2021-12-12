<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dtks Real Controller
*| --------------------------------------------------------------------------
*| Dtks Real site
*|
*/
class Dtks_real extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dtks_real');
	}

	/**
	* show all Dtks Reals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dtks_real_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dtks_reals'] = $this->model_dtks_real->get($filter, $field, $this->limit_page, $offset);
		$this->data['dtks_real_counts'] = $this->model_dtks_real->count_all($filter, $field);

		$config = [
			'base_url'     => 'dtks_real/index/',
			'total_rows'   => $this->model_dtks_real->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dtks Real List');
		$this->render('modul/dtks_real/dtks_real_list', $this->data);
	}
	
	
	
	/**
	* delete Dtks Reals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dtks_real_delete');

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
            set_message(cclang('has_been_deleted', 'dtks_real'), 'success');
        } else {
            set_message(cclang('error_delete', 'dtks_real'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dtks Reals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dtks_real_view');

		$this->data['dtks_real'] = $this->model_dtks_real->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dtks Real Detail');
		$this->render('modul/dtks_real/dtks_real_view', $this->data);
	}
	
	/**
	* delete Dtks Reals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dtks_real = $this->model_dtks_real->find($id);

		
		
		return $this->model_dtks_real->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dtks_real_export');

		$this->model_dtks_real->export('dtks_real', 'dtks_real');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dtks_real_export');

		$this->model_dtks_real->pdf('dtks_real', 'dtks_real');
	}

	public function import()
	{
		$this->is_allowed('dtks_real_import');


		$this->template->title('Data dtks_real Import');
		$this->render('modul/dtks_real/dtks_real_import');
	}

	public function upload()
	{
		$this->is_allowed('dtks_real_import');

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
				 

				 $a = db_get_all_data('dtks_real',"nik=$nik ");

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
					$insert = $this->db->insert("dtks_real",$data);
					
				
 							} 
			
                      
			}
			unlink($inputFileName);
			redirect('dtks_real/import');
			set_message("Berhasi Di Upload");  

        }

}


/* End of file dtks_real.php */
/* Location: ./application/controllers/Dtks Real.php */