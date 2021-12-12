<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bansos extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('model_bansos');
		
	}
    public function index(){
    //bansos berdasarkan jenis
     $data['hit_kks'] = $this->model_bansos->hitung_kks();
     $data['hit_pbi'] = $this->model_bansos->hitung_pbi();
     $data['hit_kip'] = $this->model_bansos->hitung_kip();
     $data['hit_pkh'] = $this->model_bansos->hitung_pkh();
     $data['hit_bpnt'] = $this->model_bansos->hitung_bpnt();
     //bansos berdasarkan keikutsertaan 
     $data['ikut_serta_pbi'] = $this->model_bansos->hitung_dis();
     $data['ikut_serta_art'] = $this->model_bansos->hitung_ren();
     //bansos disabilitas&rentan
     $data['hit_disabilitas'] = $this->model_bansos->hitung_dis();
     $data['hit_rentan'] = $this->model_bansos->hitung_ren();
     //bansos Jenis Kelamin
     $data['hit_jenis_kelamin_L'] = $this->model_bansos->hitung_JnsKel_l();
     $data['hit_jenis_kelamin_P'] = $this->model_bansos->hitung_JnsKel_p();
     //bansos usiah
     $data['bs_bayi'] = $this->model_bansos->bs_bayi();
     $data['bs_anak'] = $this->model_bansos->bs_anak();
     $data['bs_remaja'] = $this->model_bansos->bs_remaja();
     $data['bs_dewasa'] = $this->model_bansos->bs_dewasa();
     $data['bs_tua'] = $this->model_bansos->bs_tua();
     $data['bs_lansia'] = $this->model_bansos->bs_lansia();
    
    
    
    $this->render('backend/standart/bansos', $data);
    }
}
