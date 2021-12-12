<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekonomi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	    //$this->load->model('model_kesehatan');
		
	}
    public function index(){
     //data puskesmas
    // $data['hit_puskesmas'] = $this->model_kesehatan->hitung_puskesmas();
    // $data['hit_posyandu'] = $this->model_kesehatan->hitung_posyandu();
    $this->render('backend/standart/ekonomi');
    }
}
