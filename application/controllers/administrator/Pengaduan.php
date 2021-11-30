<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('model_dasboard_aduan');
	}
	
    public function index(){
    $data['total_aduan'] = $this->model_dasboard_aduan->count_aduan();
    $data['total_proses'] = $this->model_dasboard_aduan->count_aduan_proses();
    $data['total_proses'] = $this->model_dasboard_aduan->count_aduan_selesai();
    
    //klasifikasi jenis
    $data['jenis_aduan1'] = $this->model_dasboard_aduan->count_aduan_jenis_1();
    $data['jenis_aduan2'] = $this->model_dasboard_aduan->count_aduan_jenis_2();
    $data['jenis_aduan3'] = $this->model_dasboard_aduan->count_aduan_jenis_3();
    $data['jenis_aduan4'] = $this->model_dasboard_aduan->count_aduan_jenis_4();
    $data['jenis_aduan5'] = $this->model_dasboard_aduan->count_aduan_jenis_5();
    $data['jenis_aduan6'] = $this->model_dasboard_aduan->count_aduan_jenis_6();
    $data['jenis_aduan7'] = $this->model_dasboard_aduan->count_aduan_jenis_7();
    $data['jenis_aduan8'] = $this->model_dasboard_aduan->count_aduan_jenis_8();
    $data['jenis_aduan9'] = $this->model_dasboard_aduan->count_aduan_jenis_9();
    $data['jenis_aduan10'] = $this->model_dasboard_aduan->count_aduan_jenis_10();
    $data['jenis_aduan11'] = $this->model_dasboard_aduan->count_aduan_jenis_11();
    $data['jenis_aduan12'] = $this->model_dasboard_aduan->count_aduan_jenis_12();
    $data['jenis_aduan13'] = $this->model_dasboard_aduan->count_aduan_jenis_13();
    $data['jenis_aduan14'] = $this->model_dasboard_aduan->count_aduan_jenis_14();
    $data['jenis_aduan15'] = $this->model_dasboard_aduan->count_aduan_jenis_15();
    $data['jenis_aduan16'] = $this->model_dasboard_aduan->count_aduan_jenis_16();
    $data['jenis_aduan17'] = $this->model_dasboard_aduan->count_aduan_jenis_17();
    $data['jenis_aduan18'] = $this->model_dasboard_aduan->count_aduan_jenis_18();
    
    
    //periode
    $data['total_periode1'] = $this->model_dasboard_aduan->count_aduan_periode1();
    $data['total_periode2'] = $this->model_dasboard_aduan->count_aduan_periode2();
    $data['total_periode3'] = $this->model_dasboard_aduan->count_aduan_periode3();
    $data['total_periode4'] = $this->model_dasboard_aduan->count_aduan_periode4();
    $data['total_periode5'] = $this->model_dasboard_aduan->count_aduan_periode5();
    $data['total_periode6'] = $this->model_dasboard_aduan->count_aduan_periode6();
    $data['total_periode7'] = $this->model_dasboard_aduan->count_aduan_periode7();
    $data['total_periode8'] = $this->model_dasboard_aduan->count_aduan_periode8();
    $data['total_periode9'] = $this->model_dasboard_aduan->count_aduan_periode9();
    $data['total_periode10'] = $this->model_dasboard_aduan->count_aduan_periode10();
    $data['total_periode11'] = $this->model_dasboard_aduan->count_aduan_periode11();
    $data['total_periode12'] = $this->model_dasboard_aduan->count_aduan_periode12();
     
    // $data['total_proses'] = $this->model_dasboard_aduan->count_aduan_jenis_kelamin();
    
    $this->render('backend/standart/Pengaduan', $data);
    }
}
