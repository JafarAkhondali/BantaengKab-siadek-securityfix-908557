<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dashboard Controller
*| --------------------------------------------------------------------------
*| For see your board
*|
*/
class Pusat_pendidikan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	   // $this->load->model('model_dasboard');
	}

    public function index(){
    // $data['pendidikan'] = $this->model_pendidikan->count_pedidikan();
     $this->render('backend/standart/pusat_pendidikan');
    }


}