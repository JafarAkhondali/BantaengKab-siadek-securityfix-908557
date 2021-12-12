<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sepakat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index($offset = 0)
	{
		$this->is_allowed('Sepakat');
		$this->data['pagination'] = $this->pagination($config);
		$this->template->title('Layanan Umum');
		$this->render('modul/sepakat/sepakat');
	}
	
	function __rekuesEmbed($modul){
	    $kd_wilayah = get_user_data('kd_wilayah');
	    $kd_bpss = db_get_all_data('wilayah',"kd_wilayah =$kd_wilayah");
	    foreach($kd_bpss as $kd_bps){
	        $kd_wilayah_bps = $kd_bps->kd_wilayah_bps;
	        $klasifikasi = $kd_bps->klasifikasi;
	    }
	   // return  $kd_wilayah_bps;
	    $key = 'gzyUu1L54Aa79BNVHmWvYtMRFje';
	    $token = 'cf9fcec0688213aed2cb211eb54b012e';
	    
	    if($klasifikasi == 'DESA' || $klasifikasi == 'KEL'){
	        $param = 'modul='.$modul.'& desa_id='.$kd_wilayah_bps;
	    }else if($klasifikasi == 'KEC'){
	        $param = 'modul='.$modul.'&kec_id='.$kd_wilayah_bps;
	    }else if($klasifikasi == 'KAB'){
	        $param = 'modul='.$modul.'&kab_id=7303';
	    }
	   
	    
	      $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sepakat.bappenas.go.id/dmd/api/v1/embed',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'X-SEPAKAT-KEY: '.$key,
            'X-SEPAKAT-TOKEN: '.$token,
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
	    
	}
	
	public function modul($namamodul='')
	{
	    $data['iframe'] = $this->__rekuesEmbed($namamodul);
		$this->render('modul/sepakat/sepakat_desa', $data);
	}

}
